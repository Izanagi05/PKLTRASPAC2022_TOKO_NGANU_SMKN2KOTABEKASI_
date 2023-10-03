<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Foto_Barang;
use App\Models\Barang;
use Illuminate\Support\Facades\Storage;

class FotoBarangController extends Controller
{

    public function getfotobarang($id){
    try {
        $data = Barang::where('barang_id', $id)->first()->BarangFoto;
        return response()->json([
            'data' => $data,
            'message' => 'Berhasil ambil data foto',
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
    public function createfotobarang(Request $request, $id){
    try {
        $tk = $id;
        $validatedData = $request->validate([
            'file'=>'required|image',
        ]);
        $validatedData['barang_id'] = $tk;
        $validatedData['file'] =  $request->file('file')->store('fotobarang');
        Foto_Barang::create($validatedData);
        return response()->json([
            'data' => 'sukses',
            'message' => 'Berhasil tambah data foto',
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
    public function updatefotobarang(Request $request, $id){
    try {
        Foto_Barang::where('foto_barang_id', $id);
        $rules = [
            'file'=>'',
        ];
        $validasi = $request->validate($rules);
        if($validasi){

            if(!empty(Foto_Barang::find($id)->file)) {
                Storage::delete(Foto_Barang::find($id)->file);
            }
            $validasi['file'] = $request->file('file')->store('fotobarang');

            $data = Foto_Barang::where('foto_barang_id', $id)->update($validasi);
            return response()->json([
            'data' => 'sukses',
            'message' => 'Berhasil ubah data foto',
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
    public function deletefotobarang($id){
    try {
        if(!empty(Foto_Barang::find($id)->file)) {
            Storage::delete(Foto_Barang::find($id)->file);
        }
        $data = Foto_Barang::where('foto_barang_id', $id)->delete();
        return response()->json([
            'data' => 'sukses',
            'message' => 'Berhasil hapus data fotos',
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
