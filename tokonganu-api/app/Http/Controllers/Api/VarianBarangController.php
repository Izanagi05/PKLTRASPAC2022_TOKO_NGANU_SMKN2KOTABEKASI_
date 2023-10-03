<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Varian;
use Illuminate\Support\Facades\Storage;

class VarianBarangController extends Controller
{

    public function getbarangvarian($id){
    try {

        $data = Varian::where('barang_id', $id)->get();
        // foreach ($data as $key => $dt) {
        //     # code...
        //     $data[$key]['varian_foto']= $dt->VarianFoto;
        // }
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
            'foto_barang_varian' => '',
        ]);
        if($validatedData){

            if($request->file('foto_barang_varian')){
                $validateData['foto_barang_varian']= $request->file('foto_barang_varian')->store('foto_barang_varian_toko');

            }
        $validatedData['barang_id'] = $id;
        Varian::create($validatedData);
        return response()->json([
            'data' => 'sukses',
            'message' => 'Berhasil tambah data',
            'success' => true,
            'status' => 201,
        ], 201);
    }
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
            $rules = [
                "nama" => 'required',
                "harga" => 'required',
                "stok" => 'required|numeric',
                "foto_barang_varian" => 'required',
            ];
            $validasi = $request->validate($rules);
            if ($validasi) {
            if ($request->file('foto_barang_varian')) {
                if (!empty(Varian::find($id)->foto_barang_varian)) {
                    Storage::delete(Varian::find($id)->foto_barang_varian);
                }
                $validasi['foto_barang_varian'] = $request->file('foto_barang_varian')->store('foto_barang_varian_toko');
            }
        $data = Varian::where('varian_id', $id)->update($validasi);
        return response()->json([
            'data' => 'sukses',
            'message' => 'Berhasil ubah data',
            'success' => true,
            'status' => 201,
        ], 201);
    }
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
        if (!empty(Varian::find($id)->foto_barang_varian)) {
            Storage::delete(Varian::find($id)->foto_barang_varian);
        }
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
