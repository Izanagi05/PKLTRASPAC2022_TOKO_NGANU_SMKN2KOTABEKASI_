<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Toko;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TokoUserController extends Controller
{
    public function gettoko(Request $request, $id){
        // dd(Toko::get());
        // $user= User::get();
        // $user = User::select('id')->where('id', 2)->first();
        // $data= Toko::where('toko_id', $user)->first();
        // $data = $user->UserToko[1]->nama;\
        // dd($user[1]->UserToko);
        // foreach ($user as $key => $usr) {
        //     return $user->UserToko->nama;
        // }

        // $userdata = User::select('id')->where('email', $request->email)->first();
        // dd($userdata);
        $data= Toko::where('user_id', $id)->get();
        // $data= $userdata->UserToko()->nama;
        // dd($data);
        return response()->json($data);
    }

    public function createtoko(Request $request, $id){
        $user = $id;
        $validatedData = $request->validate([
            'user_id'=>'',
            'nama'=> 'required',
            'deskripsi' => 'required',
            'alamat'=> 'required',
            'no_telepon'=> 'required',
            'logo' =>'required',
        ]);

        $validatedData['user_id'] = $user;
        // dd($validatedData['user_id']);
        Toko::create($validatedData);
    }
}
