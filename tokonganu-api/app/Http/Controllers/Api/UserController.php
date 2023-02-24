<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

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

        if($request->file('foto_profil')) {
            // dd($request->oldImage);
            if($request->foto_profil) {
                Storage::delete($request->foto_profil);
            }
            $validasi['foto_profil'] = $request->file('foto_profil')->store('public/post-images');
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
