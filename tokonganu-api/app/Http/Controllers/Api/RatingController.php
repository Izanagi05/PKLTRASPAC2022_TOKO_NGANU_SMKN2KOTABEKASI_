<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use Illuminate\Validation\ValidationException;
use App\Models\Rating;
use App\Models\Barang;
class RatingController extends Controller
{

    public function getratingbybarang($id)
    {
        try {
            $rating = Rating::where('barang_id', $id)->get();


            return response()->json([
                'data' => number_format($rating, 1),
                'message' => 'Berhasil get data berdasarkan rating',
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
    public function createrating(Request $request)
    {
        try {
            //code...

        $validatedata = $request->validate([
            'user_id' => 'required|numeric',
            'barang_id' => 'required|numeric',
            'rating' => 'required|numeric|between:1,5',
        ]);
        Rating::create($validatedata);
        return response()->json([
            'data' => 'sukses',
            'message' => 'Berhasil tambah data rating',
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
    public function updaterating(Request $request, $id)
    {
        try {
            $rules = [
                'user_id' => 'required|numeric',
                'barang_id' => 'required|numeric|between:1,5',
                'rating' => 'required|numeric',
            ];
            $validate = $request->validate($rules);
            Rating::where('rating_id', $id)->update($validate);
            return response()->json([
                'data' => 'sukses',
                'message' => 'Berhasil ubah data rating',
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
    public function deleterating($id)
    {
        try {
            $data = Rating::find($id);
            $data->delete();
            return response()->json([
                'data' => 'sukses',
                'message' => 'Berhasil hapus data rating',
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
