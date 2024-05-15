<?php

namespace App\Http\Controllers\Api;


use App\models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Enums\TokenAbility;


class LoginController extends Controller
{
    public function loginUser(Request $request)
    {

        try {
            //Validation
            $validateUser = Validator::make($request->all(), [
                'email'    => 'required|email',
                'password' => 'required|min:6',
                'phone_number' => 'required'
            ]);

            if ($validateUser->fails()) {
                return response()->json([
                    "status"    => "false",
                    "message"   => "validation error",
                    "error"     => $validateUser->errors()
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            if (!$user || ! Hash::check($request->password, $user->password) || $user->phone_number != $request->phone_number) {

                return response()->json([
                    "status"    => "false",
                    "message"   => "Email & Password & phone_number does not match"
                ], 422);
            }
            return response()->json([
                "status"    => "true",
                "message"   => "User Logged In Successfully",
                "token"     => $user->createToken("API TOKEN", [''],$expiresAt = now()->addMinute(5))->plainTextToken
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                "status"    => "false",
                "message"   => $th->getMessage()
            ], 500);
        }
    }
}
