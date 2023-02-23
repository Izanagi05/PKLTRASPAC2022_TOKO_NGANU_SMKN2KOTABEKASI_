<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Toko;
use App\Models\User;

class BarangController extends Controller
{
    public function getbarang(Request $request, $id){

        // $data = User::select('id')->where('id', $userid)->first();

        // $barang= Barang::where('toko_id', $id)->get();
        // return response()->json([$barang, $data]);
        $data = Toko::where('user_id', $id)->get();


        // dd($data);
        // return $data;
        // dd(count($data));
        // return ;
        foreach ($data as $key=> $dt) {
             $data[$key]['barang']=$dt->Barang;



        }
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
}
