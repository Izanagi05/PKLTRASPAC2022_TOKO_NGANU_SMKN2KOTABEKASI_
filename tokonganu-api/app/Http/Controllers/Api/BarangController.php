<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Toko;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Foto_Barang;
use App\Models\Rating;

class BarangController extends Controller
{
    public function search($search)
    {
        try {
            $data = Barang::where('nama', 'LIKE', '%' . $search . '%')->orWhere('deskripsi', 'LIKE', '%' . $search . '%')->get();
            foreach ($data as $key => $dtv) {

                $data[$key]['barang_foto_first'] = $dtv->barangFotoFirst;
                $data[$key]['barang_varian_first'] = $dtv->barangVarianFirst;
                $data[$key]['toko'] = $dtv->Toko;
                $ratings = $dtv->BarangRating;
                $countRating=count($ratings);

                $totalRating=0;
                foreach ( $ratings as $rating) {
                    $totalRating += $rating->rating;
                }
                $averageRating = $countRating > 0 ? $totalRating / $countRating : 0;
                $data[$key]['average_rating'] = $averageRating;
            }
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
    public function getbarang($id)
    {
        try {
            $data = Barang::where('toko_id', $id)->get();
            // return response()->json($data);
            return response()->json([
                'data' => $data,
                'message' => 'Berhasil ambil data barang berdasarkan toko',
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
    public function getallbarangtoko()
    {
        try {
            $data = Barang::get();
            foreach ($data as $key => $dt) {
                $data[$key]['barang_foto_first'] = $dt->barangFotoFirst;
                $data[$key]['barang_varian_first'] = $dt->barangVarianFirst;
                $data[$key]['toko'] = $dt->Toko;

                $ratings = $dt->BarangRating;
                $countRating=count($ratings);

                $totalRating=0;
                foreach ( $ratings as $rating) {
                    $totalRating += $rating->rating;
                }
                $averageRating = $countRating > 0 ? $totalRating / $countRating : 0;
                $data[$key]['average_rating'] = $averageRating;
                // dd($averageRating);
            }
            // $data->Toko()->get();
            return response()->json([
                'data' => $data,
                'message' => 'Berhasil ambil data barang',
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
    public function getbarangtokobyid($id)
    {
        try {
            $data = Barang::where('barang_id', $id)->get();

            foreach ($data as $key => $dt) {

                $data[$key]['toko'] = $dt->Toko;
            }
            return response()->json([
                'data' => $data,
                'message' => 'Berhasil ambil',
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
    public function getbarangvariantokobyid($id)
    {
        try {
            $data = Barang::where('barang_id', $id)->get();
            foreach ($data as $key => $dtv) {
                $data[$key]['toko'] = $dtv->Toko;
                $data[$key]['barang_varian'] = $dtv->BarangVarian;
            }
            return response()->json([
                'data' => $data,
                'message' => 'Berhasil ambil data varian',
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


    public function createbarang(Request $request, $id)
    {
        try {
            $tk = $id;
            $validatedData = $request->validate([
                'toko_id' => '',
                'nama' => 'required',
                'deskripsi' => 'required',
                'kategori_id' => 'required',
            ]);

            $validatedData['toko_id'] = $tk;
            // dd($validatedData['user_id']);
            $barangg = Barang::create($validatedData);
            // $bid = $barangg->barang_id;
            // $imgdefault=public_path('makanan.jpg');
            // $validatedDataFt = [
            //     'barang_id' => $bid,
            //     'file' => $imgdefault,
            // ];
            // // Storage::disk('public')->copy($imgdefault, 'fotobarang/' . $bid . '_makanan.jpg');
            // $validatedDataFt['file'] =  $imgdefault->file('file')->store('fotobarang');
            // $validatedDataFt['file']->file('file')->store('fotobarang');
            // Foto_Barang::create($validatedDataFt);
            // $bid = $barangg->barang_id;
            // $validatedDataFt = $request->validate([
            //     'file'=>'',
            // ]);

            // $validatedDataFt['barang_id'] = $bid;
            // $validatedDataFt['file'] =  $request->file('file')->store('fotobarang');
            // Foto_Barang::create($validatedDataFt);
        } catch (\Throwable $e) {
            return response()->json([
                'data' => null,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'success' => false,
                'status' => 500,
            ], 500);
        }
    }
    public function updatebarang(Request $request, $id)
    {
        try {
            $data = Barang::where('barang_id', $id)->update([
                // "id" => $request->id,
                "nama" => $request->nama,
                "deskripsi" => $request->deskripsi,
                "kategori_id" => $request->kategori_id,
            ]);
            return response()->json([
                'data' => $data,
                'message' => 'Berhasil update',
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
    public function deletebarang($id)
    {
        try {
            $data = Barang::find($id);
            $data->BarangFoto()->delete();
            $data->barangVarian()->delete();
            foreach ($data->BarangFoto as $foto) {
                if (!empty($foto->file)) {
                    Storage::delete($foto->file);
                }
            }
            return response()->json($data, 200);
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
