<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class RegisterController extends Controller
{
    public function regisstore(Request $request){

        // dd(User::get());
        $validatedData = $request->validate([
            'nama'=> 'required',
            'email' => 'required|email:dns|unique:user',
            'password'=> 'required',
            'salt_password'=> '',
            'role_id' =>'',
            'no_telepon' =>'nullable',
            'foto_profil' =>'nullable'
        ]);
        $validatedData['salt_password'] = Str::random(32);
        $validatedData['password'] = md5($validatedData['password']).$validatedData['salt_password'];
        // Hash::make($validatedData['salt_password']);
         User::create($validatedData);
        // return csrf_token();
    }


}
