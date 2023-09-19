<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Varian;

class VarianBarangController extends Controller
{

    public function getbarangvarian($id){
    try {

        $data = Varian::where('barang_id', $id)->get();
        return response()->json([
            'data' => $data,
            'message' => 'Berhasil cari data varian',
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
    public function getvarian($id){
    try {
        $data = Varian::where('varian_id', $id)->get();
         return response()->json([
                'data' => $data,
                'message' => 'Berhasil cari',
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
    public function createvarianbarang(Request $request, $id){
        try
        {
        $validatedData = $request->validate([
            'barang_id'=>'',
            'nama'=> 'required',
            'harga' => 'required',
            'stok' => 'required',
        ]);

        $validatedData['barang_id'] = $id;
        Varian::create($validatedData);
        return response()->json([
            'data' => 'sukses',
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
    public function updatevarianbarang(Request $request, $id ){

        try {
        $data = Varian::where('varian_id', $id)->update([
            "nama" => $request->nama,
            "harga" => $request->harga,
            "stok" => $request->stok,
        ]);
        return response()->json([
            'data' => 'sukses',
            'message' => 'Berhasil ubah data',
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
    public function deletevarianbarang($id ){
    try {
        $data = Varian::where('varian_id', $id)->delete();
        return response()->json([
            'data' => $data,
            'message' => 'Berhasil hapus',
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
