<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\TokoUserController;
use App\Http\Controllers\Api\UserController;

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

Route::post('/registrasi', [RegisterController::class, 'regisstore']);
Route::post('/login', [LoginController::class, 'postlogin']);
Route::get('/gettoko', [TokoUserController::class, 'gettoko']);
Route::post('/createtoko/{id}', [TokoUserController::class, 'createtoko']);
// Route::get('/user', [UserController::class, 'getuser']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

