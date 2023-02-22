<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toko;
use App\Models\User;

class TokoUserController extends Controller
{
    public function gettoko(){
        // dd(Toko::get());
        $user= User::get();
        // $user = User::select('id')->where('id', 2)->first();
        // $data= Toko::where('toko_id', $user)->first();


        // $data = $user->UserToko[1]->nama;
        foreach ($user as $key => $usr) {
            return $user[$key]["Toko"]->UserToko;
        }
        // $data= Toko::where('toko_id', $id)->get();
        // dd($data);
        return response()->json(['data'=>$data]);
    }
}
