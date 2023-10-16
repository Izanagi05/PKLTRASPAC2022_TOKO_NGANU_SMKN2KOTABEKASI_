<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Toko;
use App\Models\Barang;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TokoUserController extends Controller
{

    public function getbarangbytokouser($id)
    {
        $data = Toko::where('user_id', $id)->get();
        foreach ($data as $key => $dt) {
            $data[$key]['barang'] = $dt->Barang;
        }
        return response()->json([
            'data' => $data,
            'message' => 'Berhasil ambil data toko barang',
            'success' => true,
            'status' => 201,
        ], 201);
    }

    public function createtoko(Request $request, $id)
    {
        try{

            $user = $id;
            $validatedData = $request->validate([
            'user_id' => '',
            'nama' => 'required|string',
            'deskripsi' => 'required',
            'alamat' => 'required|string',
            'no_telepon' => 'required|numeric',
            'logo' => '',
        ]);

        $validatedData['user_id'] = $user;
        $validatedData['logo'] = 'logotoko/default.png';
        Toko::create($validatedData);
        return response()->json([
            'data' => $validatedData,
            'message' => 'Berhasil ambil data toko barang',
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

    public function updatetoko(Request $request, $id)
    {
        // $data = Toko::where('toko_id', $id)->update([
        //     // "id" => $request->id,
        //     "nama" => $request->nama,
        //     "deskripsi" => $request->deskripsi,
        //     "alamat" => $request->alamat,
        //     "no_telepon" => $request->no_telepon,
        //     "logo" => $request->logo
        // ]);
        try{

            $rules = [
                'nama' => 'required',
            'deskripsi' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required',
            'logo' => ''
        ];
        $validasi = $request->validate($rules);
        if ($validasi) {

            if ($request->file('logo')) {
                // dd($request->oldImage);
                if (!empty(Toko::find($id)->logo)) {
                    Storage::delete(Toko::find($id)->logo);
                }
                $validasi['logo'] = $request->file('logo')->store('logotoko');
            }
            $data = Toko::where('toko_id', $id)->update($validasi);
            $validasi['toko_id']=$id;
            return response()->json([
                'data' => $validasi,
                'message' => 'Berhasil ambil data toko barang',
                'success' => true,
                'status' => 201,
            ], 201);
        }
    }catch (\Throwable $e) {
        return response()->json([
            'data' => null,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            'success' => false,
            'status' => 500,
        ], 500);
    }
    }
    public function deletetoko($id)
    {
        // $data = Toko::find($id);
        try {
            if (!empty(Toko::find($id)->logo)) {
                Storage::delete(Toko::find($id)->logo);
            }
            $data = Toko::find($id);
            $dataBarang = Barang::where('toko_id', $id)->get();
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
            }
            $data->Barang()->delete();
            $data->delete();

            return response()->json([
                'data' => 'sukses',
                'message' => 'Berhasil hapus data toko',
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
