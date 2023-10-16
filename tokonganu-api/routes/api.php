<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\TokoUserController;
use App\Http\Controllers\Api\BarangController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\KeranjangUserController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\VarianBarangController;
use App\Http\Controllers\Api\FotoBarangController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\DetailTransakasiController;
use App\Http\Controllers\Api\TransaksiController;

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

//<admin>
Route::get('/getalluser', [AdminController::class, 'getalluser']);
Route::get('/getalltoko', [AdminController::class, 'getalltoko']);
Route::delete('/deleteuser/{id}', [AdminController::class, 'deleteuser']);
//</admin>

Route::get('/getuserlogin/{id}', [UserController::class, 'getuserlogin']);
Route::post('/updateuserlogin/{id}', [UserController::class, 'updateuserlogin']);
Route::get('/gettokobyuserlogin/{id}', [UserController::class, 'gettokobyuserlogin']);

Route::get('/keranjangbyuser/{id}', [KeranjangUserController::class, 'keranjangbyuser']);
Route::get('/keranjanguser/{id}', [KeranjangUserController::class, 'keranjanguser']);
Route::get('/barangvariankeranjang/{id}', [KeranjangUserController::class, 'barangvariankeranjang']);
Route::post('/addkeranjangbyuser/{id}', [KeranjangUserController::class, 'addkeranjangbyuser']);
Route::delete('/deletekeranjang/{id}', [KeranjangUserController::class, 'deletekeranjang']);
Route::get('/barangvarianharga/{id}/varian/{varian_id}', [KeranjangUserController::class, 'barangvarianharga']);

Route::post('/updatetoko/{id}', [TokoUserController::class, 'updatetoko']);
Route::delete('/hapustoko/{id}', [TokoUserController::class, 'deletetoko']);
Route::post('/createtoko/{id}', [TokoUserController::class, 'createtoko']);
Route::get('/gettoko/{id}', [TokoUserController::class, 'getbarangbytokouser']);


Route::post('/createbarang/{id}', [BarangController::class, 'createbarang']);
Route::post('/updatebarang/{id}', [BarangController::class, 'updatebarang']);
Route::delete('/deletebarang/{id}', [BarangController::class, 'deletebarang']);
Route::get('/getbarang/{id}', [BarangController::class, 'getbarang']);
Route::get('/getallbarangtoko', [BarangController::class, 'getallbarangtoko']);
Route::get('/getbarangtokobyid/{id}', [BarangController::class, 'getbarangtokobyid']);
Route::get('/getbarangvariantokobyid/{id}', [BarangController::class, 'getbarangvariantokobyid']);
Route::get('/search/{search}', [BarangController::class, 'search']);


Route::get('/getvarianbarang/{id}', [VarianBarangController::class, 'getbarangvarian']);
Route::get('/getvarian/{id}', [VarianBarangController::class, 'getvarian']);
Route::post('/createvarianbarang/{id}', [VarianBarangController::class, 'createvarianbarang']);
Route::post('/updatevarianbarang/{id}', [VarianBarangController::class, 'updatevarianbarang']);
Route::delete('/deletevarianbarang/{id}', [VarianBarangController::class, 'deletevarianbarang']);


Route::get('/getfotobarang/{id}', [FotoBarangController::class, 'getfotobarang']);
Route::post('/createfotobarang/{id}', [FotoBarangController::class, 'createfotobarang']);
Route::post('/updatefotobarang/{id}', [FotoBarangController::class, 'updatefotobarang']);
Route::delete('/deletefotobarang/{id}', [FotoBarangController::class, 'deletefotobarang']);


Route::get('/getkategori/{id}', [KategoriController::class, 'getkategorbybarang']);
Route::get('/getallkategori', [KategoriController::class, 'getallkategori']);
Route::post('/createkategori', [KategoriController::class, 'createkategori']);
Route::delete('/deletekategori/{id}', [KategoriController::class, 'deletekategori']);
Route::post('/updatekategori/{id}', [KategoriController::class, 'updatekategori']);
// Route::get('/user', [UserController::class, 'getuser']);

Route::get('/getratingbybarang/{id}', [RatingController::class, 'getratingbybarang']);
Route::post('/createrating', [RatingController::class, 'createrating']);
Route::post('/updaterating/{id}', [RatingController::class, 'updaterating']);
Route::delete('/deleterating/{id}', [RatingController::class, 'deleterating']);


Route::get('/getdatatransakasibytoko/{id}', [TransaksiController::class, 'getdatatransakasibytoko']);
Route::post('/createtransaksi', [TransaksiController::class, 'createtransaksi']);
Route::post('/updatetransaksi/{id}', [TransaksiController::class, 'updatetransaksi']);
Route::delete('/deletetransaksi/{id}', [TransaksiController::class, 'deletetransaksi']);

Route::get('/getdatadetailtransakasibyuser/{id}', [DetailTransakasiController::class, 'getdatadetailtransakasibyuser']);
Route::post('/createdetail_transaksi', [DetailTransakasiController::class, 'createdetail_transaksi']);
Route::post('/updatedetail_transaksi/{id}', [DetailTransakasiController::class, 'updatedetail_transaksi']);
Route::delete('/deletedetail_transaksi/{id}', [DetailTransakasiController::class, 'deletedetail_transaksi']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

