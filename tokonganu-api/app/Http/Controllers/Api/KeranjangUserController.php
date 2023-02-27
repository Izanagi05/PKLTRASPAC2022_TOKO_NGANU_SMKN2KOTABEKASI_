<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Keranjang_User;
use App\Models\Barang;
use App\Models\Varian;
use Illuminate\Database\Eloquent\Builder;

class KeranjangUserController extends Controller
{
    public function keranjangbyuser($id,){
        $keranjang = User::where('id', $id)->first();


        $keranjang['user_keranjang']=$keranjang->UserKeranjang;
        // foreach ($keranjang as $key => $krnjng) {
        // }
        return response()->json($keranjang);
    }
    public function keranjanguser($id,){
        $keranjang = Keranjang_User::where('user_id', $id)->get();


        // $keranjang['user_keranjang']=$keranjang->UserKeranjang;
        // foreach ($keranjang as $key => $krnjng) {

        // }

        return response()->json($keranjang);
    }

    public function barangvarianharga($id, $varian_id){
        $keranjang= Barang::where('barang_id', $id)->with(['barangVarian' => function ($query) use($varian_id){
            $query->where('varian_id', $varian_id);
        }])->whereHas('barangVarian', function (Builder $query) use($varian_id) {
            $query->where('varian_id', $varian_id);
        })->get();
        return response()->json([$keranjang]);
    }




    public function barangvariankeranjang($id){
        $keranjang = User::where('id', $id)->get();
        $keranjangbarangid = User::where('id', $id)->get();
        $idbarang=[];
        $idvarian=[];
        // dd($barangkeranjang);
        foreach ($keranjangbarangid as $key => $krnjngbrgid) {
            $keranjangbarangid[$key]['user_keranjang']=$krnjngbrgid->UserKeranjang;
            foreach ($krnjngbrgid->UserKeranjang as $key => $value) {
                $krnjngbrgid->UserKeranjang[$key]= $value->barang_id;
                // dd($krnjngbrgid->UserKeranjang[$key]);
                $idbarang = $krnjngbrgid->UserKeranjang;
            };
        }
        $barangkeranjang = Barang::whereIn('barang_id', $idbarang)->get();
        foreach ($keranjang as $key => $krnjng) {


            $keranjang[$key]['user_keranjang']=$krnjng->UserKeranjang;
            $keranjang[$key]['barangg']=$barangkeranjang;
        }
        // $keranjang['barangvarian'] = Barang::where('id', $id);
        return response()->json([$keranjang]);
    }

    public function addkeranjangbyuser(Request $request, $id){
        $user = $id;
        $validatedData = $request->validate([
            'user_id'=>'',
            'barang_id'=> 'required',
            'kuantitas' => '',
            'varian_id' => 'unique:keranjang_user',
        ]);

        $validatedData['user_id'] = $user;
        // dd($validatedData['user_id']);
        Keranjang_User::create($validatedData);
        return response()->json($validatedData);
    }
    public function deletekeranjang($id ){
        $data = Keranjang_User::find($id);
        $data->delete();
        return response()->json($data, 200);
    }
}
