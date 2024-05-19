<?php
<<<<<<< HEAD
use App\Enums\TokenAbility;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\SignupController;
use App\Http\Controllers\Api\VerifyEmailController;
use App\Http\Controllers\Api\RefreshTokenController;
=======

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

>>>>>>> 2caf74e (task_3)

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

<<<<<<< HEAD
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

    return $request->user();

});


Route::post('/auth/signup', [SignupController::class, 'signupUser']);

Route::post('/auth/login', [LoginController::class, 'loginUser']);





Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth/refresh-token', [RefreshTokenController::class, 'refreshToken']);
    Route::post('/auth/logout', [LogoutController::class, 'logoutUser']);
    Route::post('/email/verify', [VerifyEmailController::class, 'verify']);
=======


$api_path = '/Api/';
Route::prefix('api')->group(function() use ($api_path) {
    //Auth Routes
    include __DIR__ . "{$api_path}Auth.php";
>>>>>>> 2caf74e (task_3)
});
