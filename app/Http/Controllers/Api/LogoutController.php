<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class LogoutController extends Controller
{
    public function logoutUser(Request $request)
    {
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                "status"    => "true",
                "message"   => "User Logout Successfully",
            ], 200);


    }
}
