<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function postlogin(Request $request){
        // $request->validate([

        //     'email' =>'required',
        //     'password' =>'required'
        // ]);
        if (Auth::attempt(['email'=>$request->email, 'password'=> $request->password])){
            $success['nama']= Auth::user()->nama;
            $success['email']= Auth::user()->email;
            return response()->json([
                'success' => true,
                'message'=>'login sukses',
                'data' => $success
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message'=>'login gagal',
                'data' =>null
            ]);

        }

        // $user = User::where('email', $request->email)->first();
        // $user = $user->find(Auth::user()->id);
        // return response()->json(['data' =>[
        //     'user'=>$user

        //     ]]);
    }
}
