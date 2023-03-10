<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Varian;

class VarianBarangController extends Controller
{

    public function createvarianbarang(Request $request, $id){

        $validatedData = $request->validate([
            'barang_id'=>'',
            'nama'=> 'required',
            'harga' => 'required',
            'stok' => 'required',
        ]);

        $validatedData['barang_id'] = $id;
        Varian::create($validatedData);
    }
    public function updatevarianbarang(Request $request, $id ){
        $data = Varian::where('varian_id', $id)->update([
            "nama" => $request->nama,
            "harga" => $request->harga,
            "stok" => $request->stok,
        ]);
        return response()->json($data, 200);
    }
    public function deletevarianbarang(Request $request, $id ){
        $data = Varian::where('varian_id', $id)->delete();
        return response()->json($data, 200);
    }

    public function getbarangvarian($id){
        $data = Varian::where('barang_id', $id)->get();

        return response()->json($data);

    }
    public function getvarian($id){
        $data = Varian::where('varian_id', $id)->get();

        return response()->json($data);

    }
}
