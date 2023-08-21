<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Foto_Barang;
use App\Models\Barang;
use Illuminate\Support\Facades\Storage;

class FotoBarangController extends Controller
{

    public function getfotobarang($id){
        $data = Barang::where('barang_id', $id)->first()->BarangFoto;
        // $data = Barang::get();
        // foreach ($data as $key => $dt) {
        // }
        // $data= $data->BarangFoto;
        return response()->json($data, 200);
    }
    public function createfotobarang(Request $request, $id){
        $tk = $id;
        $validatedData = $request->validate([
            'file'=>'',
        ]);

        $validatedData['barang_id'] = $tk;
        $validatedData['file'] =  $request->file('file')->store('fotobarang');
        Foto_Barang::create($validatedData);

    }
    public function updatefotobarang(Request $request, $id){

        Foto_Barang::where('foto_barang_id', $id);
        $rules = [
            'file'=>'',
        ];
        $validasi = $request->validate($rules);
        if($validasi){

            if(!empty(Foto_Barang::find($id)->file)) {
                Storage::delete(Foto_Barang::find($id)->file);
            }
            $validasi['file'] = $request->file('file')->store('fotobarang');

            $data = Foto_Barang::where('foto_barang_id', $id)->update($validasi);
            return response()->json($data, 200);
        }
        // }

    }
    public function deletefotobarang($id){
        if(!empty(Foto_Barang::find($id)->file)) {
            Storage::delete(Foto_Barang::find($id)->file);
        }
        $data = Foto_Barang::where('foto_barang_id', $id)->delete();
        return response()->json("$data", 200);
    }
}
