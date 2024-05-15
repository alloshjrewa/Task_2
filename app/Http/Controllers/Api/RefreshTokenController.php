<?php

namespace App\Http\Controllers\Api;

use App\Enums\TokenAbility;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class RefreshTokenController extends Controller
{
    public function refreshToken(Request $request)
    {
        $accessToken = $request->user()->createToken('access_token', [TokenAbility::ACCESS_API->value], Carbon::now()->addMinutes(config('sanctum.ac_expiration')));
        return response(['message' => "Token generated",
                         'token' => $accessToken->plainTextToken]);
    }
}
