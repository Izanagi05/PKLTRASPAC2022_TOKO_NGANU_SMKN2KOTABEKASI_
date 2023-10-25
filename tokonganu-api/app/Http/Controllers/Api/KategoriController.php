<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Barang;
use App\Models\Foto_Barang;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class KategoriController extends Controller
{
    public function getallkategori()
    {
        try {
            $kategori = Kategori::get();
            foreach ($kategori as $key => $dt) {
                # code...
                $dt['tgl_formatku']=Carbon::parse($dt->created_at)->formatLocalized('%e %B %Y');
            }
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
                    $data[$key]['toko'] = $dt->Toko;
                    $ratings = $dt->BarangRating;
                    $countRating = count($ratings);

                    $totalRating = 0;
                    foreach ($ratings as $rating) {
                        $totalRating += $rating->rating;
                    }
                    $averageRating = $countRating > 0 ? $totalRating / $countRating : 0;
                    $data[$key]['average_rating'] = $averageRating;
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
            $data = Kategori::find($id);
            $dataBarang = Barang::where('kategori_id', $id)->get();
            foreach ($dataBarang as $key => $brg) {
                foreach ($brg->BarangFoto as $foto) {
                    // Hapus foto dari storage
                    if (!empty($foto->file)) {
                        Storage::delete($foto->file);
                    }
                }
                foreach ($brg->barangVarian as $foto) {
                    // Hapus foto dari storage
                    if (!empty($foto->foto_barang_varian)) {
                        Storage::delete($foto->foto_barang_varian);
                    }
                }
                $brg->BarangFoto()->delete();
                $brg->barangVarian()->delete();
                // $brg->delete();
            }
            $data->Barang()->delete();
            $data->delete();
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
