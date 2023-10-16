<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Detail_Transakasi;

class DetailTransakasiController extends Controller
{
    public function getdatadetailtransakasibyuser($id){
        try {
        $data=Detail_Transakasi::where('user_id', $id)->get();
        foreach ($data as $transaction) {
            // $transaction->nama_pengguna = $transaction->detailTransaksiUser->nama;
            $transaction->nama_varian = $transaction->detailTransaksiVarian->nama;
            $transaction->nama_barang = $transaction->detailTransaksiBarang->nama;
            $transaction->nama_kategori = $transaction->detailTransaksiKategori->nama;
            $transaction->nama_toko = $transaction->detailTransaksiToko->nama;
            // unset($transaction->detailTransaksiUser);
            unset($transaction->detailTransaksiVarian);
            unset($transaction->detailTransaksiBarang);
            unset($transaction->detailTransaksiKategori);
            unset($transaction->detailTransaksiToko);
        }
        return response()->json([
            'data' => $data,
            'message' => 'Berhasil ambil data detail transakasi',
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
    public function createdetail_transaksi(Request $request, $id)
    {
        try {
            $tk = $id;
            $validatedData = $request->validate([
                'user_id' => 'required|numeric',
                'toko_id' => 'required|numeric',
                'barang_id' => 'required|numeric',
                'kategori_id' => 'required|numeric',
                'varian_id' => 'required|numeric',
                'status' => 'required',
                'transaksi_id' => 'required|numeric',
                'jumlah' => 'required',
                'subtotal' => 'required',
            ]);

            // $validatedData['toko_id'] = $tk;
            $dwtialTransaksi = Detail_Transakasi::create($validatedData);

            return response()->json([
                'data' => $validatedData,
                'message' => 'Berhasil tambah detail transakaso',
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
    public function updatedetail_transaksi(Request $request, $id)
    {
        try {
            $rules = [
                'user_id' => 'required|numeric',
                'toko_id' => 'required|numeric',
                'barang_id' => 'required|numeric',
                'kategori_id' => 'required|numeric',
                'varian_id' => 'required|numeric',
                'status' => 'required',
                'transaksi_id' => 'required|numeric',
                'tgl_transaksi' => 'required',
                'jumlah' => 'required',
                'subtotal' => 'required',
            ];
            $validasi = $request->validate($rules);
            $data = Detail_Transakasi::where('detail_transaksi_id', $id)->update($validasi);
            $validasi['detail_transaksi_id'] = $id;
            return response()->json([
                'data' => $validasi,
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
    public function deletedetail_transaksi($id)
    {
        try {
            $data = Detail_Transakasi::find($id);
            $data->delete();
            return response()->json([
                'data' => $data,
                'message' => 'Berhasil delete',
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
