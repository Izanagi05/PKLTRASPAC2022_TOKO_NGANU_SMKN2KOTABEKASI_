<?php

namespace App\Http\Controllers\Api;

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

         $uuu =User::create($validatedData);
         $success = $uuu->createToken('auth_token')->plainTextToken;
        // return csrf_token();
        return response()->json([
            "success" => true,
            "message" => "berhasil registrasi",
            "data" => $success,
        ]);
    }


}
