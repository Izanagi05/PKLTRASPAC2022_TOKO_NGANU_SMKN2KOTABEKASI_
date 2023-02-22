<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    public function getbarang($id){

        $barang= Barang::where('toko_id', $id)->get();
        return response()->json($barang);
    }
    public function createbarang(Request $request, $id){
        $tk = $id;
        $validatedData = $request->validate([
            'toko_id'=>'',
            'nama'=> 'required',
            'deskripsi' => 'required',
            'kategori_id' => 'required',
        ]);

        $validatedData['toko_id'] = $tk;
        // dd($validatedData['user_id']);
        Barang::create($validatedData);
    }
}
