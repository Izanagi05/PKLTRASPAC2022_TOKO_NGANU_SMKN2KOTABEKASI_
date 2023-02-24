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

}
