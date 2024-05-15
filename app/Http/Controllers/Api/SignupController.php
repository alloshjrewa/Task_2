<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Enums\TokenAbility;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\RegisteredUser;
use Illuminate\Support\Carbon;
use App\Mail\EmailVerification;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SignupController extends Controller
{
    public function signupUser(Request $request)
    {
        try {
            //Validation
            $validateUser = Validator::make($request->all(), [
                'name'     => 'required|unique:users',
                'email'    => 'required|email|unique:users,email',
                'password' => 'required|confirmed:password|min:6',
                'phone_number' => 'required|unique:users',
                'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'certificate' => 'required|mimes:pdf|max:2048'
            ]);

            if ($validateUser->fails()) {

                return response()->json([
                    "status"    => "false",
                    "message"   => "validation error",
                    "error"     => $validateUser->errors()
                ], 422);
            }

            // Profile Photo Path
            $photo_name = $request->profile_photo->getClientOriginalName();
            $photo_fileName = pathinfo($photo_name, PATHINFO_FILENAME);
            $photo_extension = $request->profile_photo->getClientOriginalExtension();

            $final_photo_name = $photo_fileName . "_" . $request->name . "." . $photo_extension;
            $photo_path = $request->file('profile_photo')
                ->storeAs('public/profile_photos', $final_photo_name);

            // certificate Path
            $certificate_name = $request->certificate->getClientOriginalName();
            $certificate_fileName = pathinfo($certificate_name, PATHINFO_FILENAME);
            $certificate_extension = $request->certificate->getClientOriginalExtension();

            $final_certificate_name = $certificate_fileName . "_" . $request->name . "." . $certificate_extension;

            $certificate_path = $request->file('certificate')
                ->storeAs('public/certificates', $final_certificate_name);

            //User Register
            $user = User::create([
                'name'                      => $request->name,
                'email'                     => $request->email,
                'password'                  => Hash::make($request->password),
                'phone_number'              => $request->phone_number,
                'profile_photo'             => $photo_path,
                'certificate'               => $certificate_path,
                'remember_token'            => Str::random(6),
                'remember_token_expiration' => Carbon::now()->addMinutes(3)
            ]);
            event(new RegisteredUser($user));
            $accessToken = $user->createToken('access_token', [TokenAbility::ACCESS_API->value], Carbon::now()->addMinutes(config('sanctum.ac_expiration')));
            $refreshToken = $user->createToken('refresh_token', [TokenAbility::ISSUE_ACCESS_TOKEN->value], Carbon::now()->addMinutes(config('sanctum.rt_expiration')));

            return response()->json([
                "status"    => "true",
                "message"   => "you signed up successfully ,we send a email verification to your email so please verify your email",
                "token"     => $accessToken->plainTextToken,
                "refreshToken" => $refreshToken->plainTextToken

            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                "status"    => "false",
                "message"   => $th->getMessage()
            ], 500);
        }
    }

}
