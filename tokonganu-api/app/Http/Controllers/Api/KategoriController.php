<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Barang;

class KategoriController extends Controller
{
    // public function getkategorbybarang($id){
    //     $kategori= Barang::where('kategori_id', $id)->get();
    //     return response()->json($kategori);
    // }
    public function getallkategori(){
        $kategori= Kategori::get();
        return response()->json($kategori);
    }
    public function getkategorbybarang($id){
        $kategori= Kategori::where('kategori_id', $id)->get();
        foreach ($kategori as $key => $ktgr) {
            $kategori[$key]['barang']=$ktgr->Barang;
        }
        return response()->json($kategori);
    }
    public function createkategori(Request $request){
        $validatedata= $request->validate([
            'nama'=>'required|unique:kategori'
        ]);

        Kategori::create($validatedata);
    }
    public function updatekategori(Request $request, $id){
        $rules=[
            'nama'=>'required'
        ];
        $validate= $request->validate($rules);

        Kategori::where('kategori_id', $id)->update($validate);


    }
    public function deletekategori(Request $request, $id ){
        $data = Kategori::where('kategori_id', $id)->delete();
        // $data="tes";
        return response()->json($data, 200);
    }

}
