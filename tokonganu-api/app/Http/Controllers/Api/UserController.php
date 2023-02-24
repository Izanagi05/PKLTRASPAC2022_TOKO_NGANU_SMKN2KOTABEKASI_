<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getallUser(){
        $data = User::get();
        return response()->json(['data'=>$data], 200);
    }

    public function getuserlogin($id){
        $data = User::where('id', $id)->first();

        return response()->json($data, 200);

    }
    public function updateuserlogin(Request $reqeust, $id){
        $data = User::where('id', $id)->update([
            'nama'=>$reqeust->nama,
            'email'=>$reqeust->email,
            'no_telepon'=>$reqeust->no_telepon,
            'foto_profil'=>$reqeust->foto_profil,
        ]);

        return response()->json($data, 200);
    }


    public function gettokobyuserlogin(Request $request, $id){
        $data= User::where('id', $id)->get();
        // $data= $userdata->UserToko()->nama;
        // dd($data);
        foreach ($data as $key=> $dt) {
            $data[$key]['user_toko']=$dt->UserToko;

       }
        return response()->json($data);
    }
    public function keranjangbyuser($id){
        $keranjang = User::where('id', $id)->get();
        foreach ($keranjang as $key => $krnjng) {
           $keranjang[$key]['user_keranjang']=$krnjng->UserKeranjang;
        }
        return response()->json($keranjang);
    }
}
