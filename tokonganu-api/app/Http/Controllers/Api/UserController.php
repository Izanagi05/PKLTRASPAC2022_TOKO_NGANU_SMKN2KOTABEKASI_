<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{


    public function getuserlogin($id)
    {
        try {
            $data = User::where('id', $id)->first();
            return response()->json([
                'data' => $data,
                'message' => 'Berhasil ambil data user login',
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
    public function updateuserlogin(Request $request, $id)
    {
        try {
            $validateData = $request->validate([
                'nama' => 'required',
                'email' => 'required|email:dns',
                'no_telepon' => 'required',
                // 'kutipan'=>'required',
                'foto_profil' => 'image',
            ]);
            if ($validateData) {
                if ($request->file('foto_profil')) {
                    if (!empty(User::find($id)->foto_profil)) {
                        Storage::delete(User::find($id)->foto_profil);
                    }
                    $validateData['foto_profil'] = $request->file('foto_profil')->store('post-images');
                }
                $data = User::findOrFail($id);
                $data->update($validateData);
                return response()->json([
                    'data' => 'sukses',
                    'message' => 'Berhasil update data',
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
    public function gettokobyuserlogin(Request $request, $id)
    {
        try{
        $data = User::where('id', $id)->get();
        foreach ($data as $key => $dt) {
            $data[$key]['user_toko'] = $dt->UserToko;
        }
        return response()->json([
            'data' => $data,
            'message' => 'Berhasil ambil data user login',
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
