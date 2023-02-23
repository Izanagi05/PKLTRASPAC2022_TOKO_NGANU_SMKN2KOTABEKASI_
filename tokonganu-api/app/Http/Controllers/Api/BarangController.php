<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Toko;
use App\Models\User;

class BarangController extends Controller
{
    public function getbarang(Request $request, $id){
        $data = Barang::where('toko_id', $id)->get();

        return response()->json($data);


        // for ($i=0; $i <count($data) ; $i++) {
        //      $data[$i];

        //      foreach ($data->first()->Barang as $key => $k) {
        //         return $k;
        //      }

        // }
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
    public function updatebarang(Request $request, $id ){
        $data = Barang::where('barang_id', $id)->update([
            // "id" => $request->id,
            "nama" => $request->nama,
            "deskripsi" => $request->deskripsi,
            "kategori_id" => $request->kategori_id,
        ]);

        // dd($id);
        return response()->json($data, 200);
    }
}
