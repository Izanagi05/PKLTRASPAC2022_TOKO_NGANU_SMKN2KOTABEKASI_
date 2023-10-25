<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Varian;
use App\Models\Toko;
use App\Models\User;
use App\Models\Detail_Transakasi;

class TransaksiController extends Controller
{
    public function getdatatransakasibytoko($id)
    {
        try {
            $data = Transaksi::where('toko_id', $id)->get();

            foreach ($data as $transaction) {
                $transaction->nama_pengguna = $transaction->transaksiUser->nama;
                $transaction->nama_varian = $transaction->transaksiVarian->nama;
                $transaction->nama_barang = $transaction->transaksiBarang->nama;
                $transaction->nama_kategori = $transaction->transaksiKategori->nama;
                $transaction->nama_toko = $transaction->transaksiToko->nama;
                unset($transaction->transaksiUser);
                unset($transaction->transaksiVarian);
                unset($transaction->transaksiBarang);
                unset($transaction->transaksiKategori);
                unset($transaction->transaksiToko);
            }
            return response()->json([
                'data' => $data,
                'message' => 'Berhasil ambil data transaksi',
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
    public function createtransaksi(Request $request,)
    {
        try {
            // $tk = $id;
            $validatedData = [
                'user_id' => 'required|numeric',
                'toko_id' => 'required|numeric',
                'barang_id' => 'required|numeric',
                'kategori_id' => 'required|numeric',
                'varian_id' => 'required|numeric',
                // 'admin_konfirmasi' => '',
                'status' => '',
                'jumlah' => 'required',
                'total_harga' => 'required',
            ];
            $req = $request->validate($validatedData);
            $req['status'] = "Belum bayar";
            $dwtialTransaksi = Transaksi::create($req);

            return response()->json([
                'data' => $validatedData,
                'message' => 'Berhasil tambah transakaso',
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
    public function updatetransaksi(Request $request, $id)
    {
        try {
            $rules = [
                'user_id' => 'required|numeric',
                'toko_id' => 'required|numeric',
                'barang_id' => 'required|numeric',
                'kategori_id' => 'required|numeric',
                'varian_id' => 'required|numeric',
                'admin_konfirmasi' => '',
                'status' => 'required',
                'jumlah' => 'required',
                'total_harga' => 'required',
            ];
            $validasi = $request->validate($rules);
            $transaksiSebelumPembaruan = Transaksi::where('transaksi_id', $id)->first();
            if ($validasi['admin_konfirmasi'] === "Ya" || $validasi['admin_konfirmasi'] === 'Tidak') {
                Transaksi::where('transaksi_id', $id)->update($validasi);
            }

            $validatedData = [
                'user_id' => 'required|numeric',
                'toko_id' => 'required|numeric',
                'barang_id' => 'required|numeric',
                'kategori_id' => 'required|numeric',
                'varian_id' => 'required|numeric',
                'status' => '',
                'transaksi_id' => '',
                'jumlah' => 'required',
                'subtotal' => '',
            ];
            $req = $request->validate($validatedData);
            $hargapervarian = Varian::where('varian_id', $transaksiSebelumPembaruan->varian_id)->value('harga');
            if ($validasi['admin_konfirmasi'] === "Ya"  && $transaksiSebelumPembaruan->admin_konfirmasi !== "Ya") {

                // $hargapervarian= Varian::where('varian_id', $transaksiSebelumPembaruan->varian_id)->select('harga')->first();
                // dd($hargapervarian);
                $req['user_id'] = $transaksiSebelumPembaruan->user_id;
                $req['toko_id'] = $transaksiSebelumPembaruan->toko_id;
                $req['barang_id'] = $transaksiSebelumPembaruan->barang_id;
                $req['kategori_id'] = $transaksiSebelumPembaruan->kategori_id;
                $req['varian_id'] = $transaksiSebelumPembaruan->varian_id;
                $req['status'] = $transaksiSebelumPembaruan->status;
                $req['transaksi_id'] = $transaksiSebelumPembaruan->transaksi_id;
                $req['jumlah'] = $transaksiSebelumPembaruan->jumlah;
                $req['subtotal'] = floatval($transaksiSebelumPembaruan->jumlah) * $hargapervarian;

                $stokSebelumPembaruan = Varian::where('varian_id', $transaksiSebelumPembaruan->varian_id)->value('stok');
                $jumlahYangAkanDikurangkan = $transaksiSebelumPembaruan->jumlah;
                if ($stokSebelumPembaruan >= $jumlahYangAkanDikurangkan) {
                    Detail_Transakasi::create($req);
                    Varian::where('varian_id', $transaksiSebelumPembaruan->varian_id)->decrement('stok', $jumlahYangAkanDikurangkan);
                }
                // Varian::where('varian_id', $transaksiSebelumPembaruan->varian_id)->decrement('stok', $transaksiSebelumPembaruan->jumlah);
                // Varian::where('varian_id', $transaksiSebelumPembaruan->varian_id)->update([
                //     'stok'=>-$transaksiSebelumPembaruan->jumlah
                // ]);
            } elseif ($validasi['admin_konfirmasi'] !== 'Ya') {
            } else {

                //     if($validasi['admin_konfirmasi']==="Ya"  && $transaksiSebelumPembaruan->admin_konfirmasi === "Ya"){
                $req['user_id'] = $transaksiSebelumPembaruan->user_id;
                $req['toko_id'] = $transaksiSebelumPembaruan->toko_id;
                $req['barang_id'] = $transaksiSebelumPembaruan->barang_id;
                $req['kategori_id'] = $transaksiSebelumPembaruan->kategori_id;
                $req['varian_id'] = $transaksiSebelumPembaruan->varian_id;
                $req['status'] = $validasi['status'];
                $req['transaksi_id'] = $transaksiSebelumPembaruan->transaksi_id;
                $req['jumlah'] = $transaksiSebelumPembaruan->jumlah;
                $req['subtotal'] = floatval($transaksiSebelumPembaruan->jumlah) * $hargapervarian;
                Detail_Transakasi::where('transaksi_id', $transaksiSebelumPembaruan->transaksi_id)->update($req);
            }

            // }
            // if($validasi['admin_konfirmasi']!=="Ya"  && $transaksiSebelumPembaruan->admin_konfirmasi === "Ya"){
            //     $req['user_id']=$transaksiSebelumPembaruan->user_id;
            //     $req['toko_id']=$transaksiSebelumPembaruan->toko_id;
            //     $req['barang_id']=$transaksiSebelumPembaruan->barang_id;
            //     $req['kategori_id']=$transaksiSebelumPembaruan->kategori_id;
            //     $req['varian_id']=$transaksiSebelumPembaruan->varian_id;
            //     $req['status']=null;
            //     $req['transaksi_id']=$id;
            //     $req['jumlah']=$transaksiSebelumPembaruan->jumlah;
            //     $req['subtotal']=floatval($transaksiSebelumPembaruan->jumlah)*$hargapervarian;

            // }
            // if( $validasi['admin_konfirmasi']==="Tidak")
            $validasi['transaksi_id'] = $id;
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
    public function deletetransaksi($id)
    {
        try {
            $data = Transaksi::find($id);
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