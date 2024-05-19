<?php

namespace App\Http\Controllers\Api;

use App\Models\User;

use Illuminate\Http\Request;
use App\Traits\AuthUserTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthUserRequest;
use App\Http\Requests\VerifyEmailRequest;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Database\QueryException;
use PhpParser\Node\Stmt\Catch_;

class AuthController extends Controller
{
    use AuthUserTrait;


    public function signupUser(AuthUserRequest $request)
    {
            $user = $this->SignupProcess($request);

            $this->SignupCreateTokenProcess($user);

    }

    public function loginUser(AuthUserRequest $request)
    {

        $user = User::where('email', $request->email)->first();

            $this->LoginProcess($user , $request);

    }

    //Logout Process
    public function logoutUser(Request $request)
    {
        $this->LogoutProcess($request);

    }

    //Refresh Token

    public function refreshToken(Request $request){

        $true_or_false = $this->TokenCheckProcess($request->user()->currentAccessToken());

        if($true_or_false){

        $this->refreshTokenProcess($request);

        }
    }

    //Email Verification

    public function verifyEmail (VerifyEmailRequest $request){

        $user = User::where('verification_code' , '=' , $request->token)->where('id', '=' , $request->id)->first();
        $this->verifyEmailProcess($user);

     }
}

