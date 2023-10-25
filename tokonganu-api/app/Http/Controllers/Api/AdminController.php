<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Rating;
use App\Models\Toko;
use App\Models\Transaksi;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function getalluser(){
        try {
        $data = User::where('role_id', 2)->get();
        return response()->json([
            'data' => $data,
            'message' => 'Berhasil ambil data semua user',
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
    public function deleteuser($id){
        try {
        $data = User::find($id);
        $data->UserToko()->delete();
        $barang =  Toko::where('user_id', $id)->get();
        foreach ($barang as $key => $brg) {
             $brg->Barang()->delete();
             $brg->delete();
        }
        $data->delete();
        return response()->json([
            'data' => 'sukses',
            'message' => 'Berhasil hapus data user',
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

    public function getalltoko(){
        try {
        $data = Toko::get();
        return response()->json([
            'data' => $data,
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
    public function getjumlahallbarangkategorirating(){
        try {
            //code...
            $data=[];
            $data['JBarang']=count(Barang::all());
            $data['JKategori']=count(Kategori::all());
            $data['JRating']=count(Rating::all());
            // foreach ($data as $key => $dt) {
            //     $dt->jumlahbarang=$dt['JBarang'];
            //     # code...
            // }
            return response()->json([
                'data' => $data,
                'message' => 'Berhasil ambil data',
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

    public function gettransaksiterbaru(){
        try {
            //code...
            $data=Transaksi::latest()
            ->take(10) // Ambil 10 hasil terbaru
            ->get();
            foreach ($data as $transaction) {
                $transaction->xjumlah = 'x ' . $transaction->jumlah;
                $transaction->foto_barang_first = $transaction->transaksiFotoBarangFirst->file;
                $transaction['ftgl_transaksi']= Carbon::parse($transaction->tgl_transakasi)->format('d/m/Y');
                $transaction->nama_pengguna = $transaction->transaksiUser->nama;
                $transaction->nama_varian = $transaction->transaksiVarian->nama;
                $transaction->nama_barang = $transaction->transaksiBarang->nama;
                $transaction->nama_kategori = $transaction->transaksiKategori->nama;
                $transaction->nama_toko = $transaction->transaksiToko->nama;
                $transaction->ongkos_kirim = '5000';
                unset($transaction->transaksiUser);
                unset($transaction->transaksiVarian);
                unset($transaction->transaksiBarang);
                unset($transaction->transaksiKategori);
                unset($transaction->transaksiToko);
                unset($transaction->transaksiFotoBarangFirst);
            }
            return response()->json([
                'data' => $data,
                'message' => 'Berhasil ambil data',
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
    public function templet(){
        try {
            //code...
            $data=Transaksi::get();
            return response()->json([
                'data' => $data,
                'message' => 'Berhasil ambil data',
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
