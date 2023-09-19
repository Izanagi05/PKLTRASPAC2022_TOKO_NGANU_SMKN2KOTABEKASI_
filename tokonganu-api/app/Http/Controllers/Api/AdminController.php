<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Toko;

class AdminController extends Controller
{
    public function getalluser(){
        try {
        $data = User::where('role_id', 2)->get();
        return response()->json([
            'data' => $data,
            'message' => 'Berhasil ambil data semua user',
            'success' => true,
            'status' => 201,
        ], 201);
    } catch (\Throwable $e) {
        return response()->json([
            'data' => null,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            'success' => false,
            'status' => 500,
        ], 500);
    }
    }
    public function deleteuser($id){
        try {
        $data = User::find($id);
        $data->UserToko()->delete();
        $barang =  Toko::where('user_id', $id)->get();
        foreach ($barang as $key => $brg) {
             $brg->Barang()->delete();
             $brg->delete();
        }
        $data->delete();
        return response()->json([
            'data' => 'sukses',
            'message' => 'Berhasil hapus data user',
            'success' => true,
            'status' => 201,
        ], 201);
    } catch (\Throwable $e) {
        return response()->json([
            'data' => null,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            'success' => false,
            'status' => 500,
        ], 500);
    }
    }

    public function getalltoko(){
        try {
        $data = Toko::get();
        return response()->json([
            'data' => $data,
            'message' => 'Berhasil tambah data',
            'success' => true,
            'status' => 201,
        ], 201);
    } catch (\Throwable $e) {
        return response()->json([
            'data' => null,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            'success' => false,
            'status' => 500,
        ], 500);
    }

    }
}
