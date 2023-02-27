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
        $rules = [
            'nama'=>'',
            'email'=>'',
            'no_telepon'=>'',
            'foto_profil'=>''
        ];
        $validasi = $request->validate($rules);

        if($request->file('foto_profil')) {
            // dd($request->oldImage);
            // return $request->foto_profil;
            // $image = time().'.'.$request->foto_profil->extension();
            if(!empty(User::find($id)->foto_profil)) {
                // unlink('storage/public/post-images'.User::where('id', $id)->foto_profil);
                Storage::delete(User::find($id)->foto_profil);
                // unlink(storage_path('public/post-images'.User::find($id)->foto_profil));
                // dd("tes");

            }
            $validasi['foto_profil'] = $request->file('foto_profil')->store('post-images');
        }
        $data = User::where('id', $id)->update($validasi);

        // return response()->json($data, 200);
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
