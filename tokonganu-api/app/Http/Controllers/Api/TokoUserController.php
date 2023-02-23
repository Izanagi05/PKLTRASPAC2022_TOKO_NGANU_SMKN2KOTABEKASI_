<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Toko;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TokoUserController extends Controller
{
    public function getalltoko(){
        $data = Toko::get();
        return response()->json($data);

    }
    public function gettoko(Request $request, $id){
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

    public function updatetoko(Request $request, $id ){
        $data = Toko::where('toko_id', $id)->update([
            // "id" => $request->id,
            "nama" => $request->nama,
            "deskripsi" => $request->deskripsi,
            "alamat" => $request->alamat,
            "no_telepon" => $request->no_telepon,
            "logo" => $request->logo
        ]);

        // dd($id);
        return response()->json($data, 200);
    }
}
