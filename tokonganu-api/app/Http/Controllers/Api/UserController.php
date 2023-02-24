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
    public function updateuserlogin(Request $request, $id){
        $rules = [
            'nama'=>'required',
            'email'=>'required|email:dns',
            'no_telepon'=>'',
            'foto_profil'=>''
        ];
        $validasi = $request->validate($rules);
        // if($request->hasFile('foto_profil')){
        //     $request->file('foto_profil')->move('uprofil/', $request->file('foto_profil')->getClientOriginalName());
        //     $data->foto_profil= $request->file('foto_profil')->getClientOriginalName();
        //     $data->save();
        // }
        if($request->file('foto_profil')) { //true jika ada request foto berupa file foto_profil kloa gaada request(up foto) sblum di insert ngambil foto di unsplash
            $validasi['foto_profil'] = $request->file('foto_profil')->store('post-images'); //klo kosong ga dijalanin krena false. kalo ada isinya dijalanain karena true
        }
        $data = User::where('id', $id)->update($validasi);

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

}
