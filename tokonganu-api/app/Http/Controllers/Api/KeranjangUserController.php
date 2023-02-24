<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Keranjang_User;

class KeranjangUserController extends Controller
{
    public function keranjangbyuser($id){
        $keranjang = User::where('id', $id)->get();
        foreach ($keranjang as $key => $krnjng) {
           $keranjang[$key]['user_keranjang']=$krnjng->UserKeranjang;
        }
        return response()->json($keranjang);
    }
    public function addkeranjangbyuser(Request $request, $id){
        $user = $id;
        $validatedData = $request->validate([
            'user_id'=>'',
            'barang_id'=> 'required|unique:keranjang_user',
            'kuantitas' => '',
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
