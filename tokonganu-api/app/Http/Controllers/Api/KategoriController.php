<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Barang;

class KategoriController extends Controller
{
    public function getallkategori()
    {
        try {
            $kategori = Kategori::get();
            return response()->json([
                'data' => $kategori,
                'message' => 'Berhasil get data kategori',
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
    public function getkategorbybarang($id)
    {
        try {
            $kategori = Kategori::where('kategori_id', $id)->get();
            foreach ($kategori as $key => $ktgr) {
                $kategori[$key]['barang'] = $ktgr->Barang;
                foreach ($kategori[$key]['barang'] as $key => $dt) {
                    $data[$key]['barang_foto_first'] = $dt->barangFotoFirst;
                    $data[$key]['barang_varian_first'] = $dt->barangVarianFirst;
                    # code...
                }
            }
            return response()->json([
                'data' => $kategori,
                'message' => 'Berhasil get data berdasarkan kategori',
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
    public function createkategori(Request $request)
    {
        $validatedata = $request->validate([
            'nama' => 'required|unique:kategori'
        ]);
        Kategori::create($validatedata);
    }
    public function updatekategori(Request $request, $id)
    {
        try {
            $rules = [
                'nama' => 'required'
            ];
            $validate = $request->validate($rules);
            Kategori::where('kategori_id', $id)->update($validate);
            return response()->json([
                'data' => 'sukses',
                'message' => 'Berhasil ubah data kategori',
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
    public function deletekategori($id)
    {
        try {
            $data = Kategori::where('kategori_id', $id)->delete();
            return response()->json([
                'data' => 'sukses',
                'message' => 'Berhasil hapus data',
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
