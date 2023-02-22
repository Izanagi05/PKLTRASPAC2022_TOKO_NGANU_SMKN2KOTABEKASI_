<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TokoUserController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::post('/registrasi', [RegisterController::class, 'regisstore']);
// Route::post('/login', [LoginController::class, 'postlogin']);
// Route::get('/gettoko', [TokoUserController::class, 'gettoko']);
// Route::post('/createtoko/{id}', [TokoUserController::class, 'createtoko']);
// Route::get('/user', [UserController::class, 'getuser']);
