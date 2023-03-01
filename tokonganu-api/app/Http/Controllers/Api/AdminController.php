<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Toko;

class AdminController extends Controller
{
    public function getalluser(){
        $data = User::where('role_id', 2)->get();
        return response()->json($data, 200);
    }
    public function deleteuser($id){
        $data = User::find($id);
        $data->UserToko()->delete();
        $barang =  Toko::where('user_id', $id)->get();
        foreach ($barang as $key => $brg) {
             $brg->Barang()->delete();
             $brg->delete();
        }
        // $barang->Barang()->delete();
        // dd($barang);

        // $barang->delete();
        $data->delete(); 
        return response()->json($data, 200);
    }

    public function getalltoko(){
        $data = Toko::get();
        return response()->json($data);

    }
}
