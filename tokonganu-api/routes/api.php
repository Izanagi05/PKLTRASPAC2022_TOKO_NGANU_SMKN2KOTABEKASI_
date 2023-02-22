<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\TokoUserController;
use App\Http\Controllers\Api\BarangController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\KategoriController;

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
Route::post('/createtoko/{id}', [TokoUserController::class, 'createtoko']);
Route::get('/gettoko/{id}', [TokoUserController::class, 'gettoko']);
Route::post('/createbarang/{id}', [BarangController::class, 'createbarang']);
Route::get('/getbarang/{id}', [BarangController::class, 'getbarang']);
Route::get('/getkategori/{id}', [KategoriController::class, 'getkategori']);
// Route::get('/user', [UserController::class, 'getuser']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

