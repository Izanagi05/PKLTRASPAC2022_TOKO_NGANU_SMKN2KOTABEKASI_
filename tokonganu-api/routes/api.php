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


Route::get('/getuserlogin/{id}', [UserController::class, 'getuserlogin']);
Route::post('/updateuserlogin/{id}', [UserController::class, 'updateuserlogin']);
Route::get('/gettokobyuserlogin/{id}', [UserController::class, 'gettokobyuserlogin']);
Route::get('/keranjangbyuser/{id}', [UserController::class, 'keranjangbyuser']);

Route::post('/updatetoko/{id}', [TokoUserController::class, 'updatetoko']);
Route::delete('/hapustoko/{id}', [TokoUserController::class, 'deletetoko']);
Route::post('/createtoko/{id}', [TokoUserController::class, 'createtoko']);
Route::get('/gettoko/{id}', [TokoUserController::class, 'getbarangbytokouser']);
Route::get('/getalltoko', [TokoUserController::class, 'getalltoko']);


Route::post('/createbarang/{id}', [BarangController::class, 'createbarang']);
Route::post('/updatebarang/{id}', [BarangController::class, 'updatebarang']);
Route::delete('/deletebarang/{id}', [BarangController::class, 'deletebarang']);
Route::get('/getbarang/{id}', [BarangController::class, 'getbarang']);
Route::get('/getkategori/{id}', [KategoriController::class, 'getkategorbybarang']);

Route::get('/getallkategori', [KategoriController::class, 'getallkategori']);
// Route::get('/user', [UserController::class, 'getuser']);





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

