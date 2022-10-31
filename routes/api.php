<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login/user', [AuthController::class, 'login']);
Route::group(['middleware' => ['jwt.auth']], function(){
    // AuthController
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

    // UserController
    Route::get('user', [UserController::class, 'index']);
    Route::post('user', [UserController::class, 'store']);
    Route::get('user/{id}', [UserController::class, 'show']);
    Route::put('user/{id}', [UserController::class, 'update']);
    Route::delete('user/{id}', [UserController::class, 'destroy']);

    // PermissionController
    Route::get('permission', [PermissionController::class, 'index']);
    Route::post('permission', [PermissionController::class, 'store']);
    Route::get('permission/{id}', [PermissionController::class, 'show']);
    Route::put('permission/{id}', [PermissionController::class, 'update']);
    Route::delete('permission/{id}', [PermissionController::class, 'destroy']);

    // MenuController
    Route::get('menu', [MenuController::class, 'index']);
    Route::post('menu', [MenuController::class, 'store']);
    Route::get('menu/{id}', [MenuController::class, 'show']);
    Route::put('menu/{id}', [MenuController::class, 'update']);
    Route::delete('menu/{id}', [MenuController::class, 'destroy']);

});
