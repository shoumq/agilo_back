<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [ProfileController::class, 'register']);
Route::post('edit_profile', [UserController::class, 'edit']);

Route::post('create_group', [GroupController::class, 'createGroup']);
Route::get('get_groups/{user_id}', [GroupController::class, 'getGroups']);

Route::post('create_password/{sector_id}', [PasswordController::class, 'createPassword']);
Route::get('get_passwords/{sector_id}', [PasswordController::class, 'getPasswords']);
Route::get('get_password/{pass_id}', [PasswordController::class, 'getPassword']);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});
