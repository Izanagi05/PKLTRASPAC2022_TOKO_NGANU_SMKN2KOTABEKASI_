<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Toko;
use App\Models\User;

class BarangController extends Controller
{
    public function search($search){
        $data= Barang::where('nama', 'LIKE', '%'.$search.'%')->orWhere('deskripsi', 'LIKE', '%'.$search.'%')->get();
        return response()->json($data);
    }
    public function getbarang(Request $request, $id){
        $data = Barang::where('toko_id', $id)->get();

        return response()->json($data);

    }
    public function getallbarangtoko(){
        $data = Barang::get();

        foreach ($data as $key => $dt) {

            $data[$key]['toko'] =$dt->Toko;
        }
        return response()->json($data);

    }
    // public function getbarangkeranjangid(){
    //     $data = Barang::get();


    //     return response()->json($data);

    // }
    public function getbarangtokobyid($id){
        $data = Barang::where('barang_id', $id)->get();

        foreach ($data as $key => $dt) {

            $data[$key]['toko'] =$dt->Toko;
        }
        return response()->json($data);

    }
    public function getbarangvariantokobyid($id){
        $data = Barang::where('barang_id', $id)->get();
        $data = Barang::where('barang_id', $id)->get();

        foreach ($data as $key => $dtv) {

            $data[$key]['toko'] =$dtv->Toko;
                $data[$key]['barang_varian'] =$dtv->BarangVarian;
        }
        return response()->json($data);

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
    public function deletebarang(Request $request, $id ){
        $data = Barang::where('barang_id', $id)->delete();
        // $data="tes";
        return response()->json($data, 200);
    }
}
