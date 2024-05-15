<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    public function __construct() {

        // $this->middleware('auth:sanctum');
    }

    public function verify (Request $request){
       $user = User::where('remember_token' , '=' , $request->token)->first();
       if(Carbon::now() > $user->remember_token_expiration){
        return response()->json([
            "status"    => "flase",
            "message"   => "Email Verification Expired"
        ], 401);
       }
        if(!empty($user && Carbon::now() < $user->remember_token_expiration)){
        $user->email_verified_at = Carbon::now();
        $user->save();
        return response()->json([
        "status"    => "true",
        "message"   => "Your Email Verified successfully"
    ], 200);
        }

    }
}
