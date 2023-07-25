<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{



    public function getuserlogin($id){
        $data = User::where('id', $id)->first();

        return response()->json($data, 200);

    }
    public function updateuserlogin(Request $request, $id){
        $validateData= $request->validate([
            'nama'=>'required',
            'email'=>'required|email:dns',
            'no_telepon'=>'required',
            // 'kutipan'=>'required',
            'foto_profil'=>'image',
        ]);
        if($validateData){
            if ($request->file('foto_profil')) {
                if(!empty(User::find($id)->foto_profil)) {
                    Storage::delete(User::find($id)->foto_profil);

                }
                $validateData['foto_profil'] = $request->file('foto_profil')->store('post-images');
            }


        $data = User::findOrFail($id);
        // $data->makeHidden('id');
        $data->update($validateData);

        return response()->json($data, 200);

    }
        // $rules = [
        //     'nama'=>'',
        //     'email'=>'',
        //     'no_telepon'=>'',
        //     'foto_profil'=>''
        // ];
        // $validasi = $request->validate($rules);

        // if($request->file('foto_profil')) {


        //     if(!empty(User::find($id)->foto_profil)) {
        //         Storage::delete(User::find($id)->foto_profil);

        //     }
        //     $validasi['foto_profil'] = $request->file('foto_profil')->store('post-images');
        // }
        // $data = User::where('id', $id)->update($validasi);
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
