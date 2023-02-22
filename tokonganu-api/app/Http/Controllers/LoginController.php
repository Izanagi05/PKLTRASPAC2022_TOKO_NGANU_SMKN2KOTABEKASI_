<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
// use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function postlogin(Request $request){

        // dd(md5($request->password).$salt_password->salt_password);
        // dd($request->session()->put('email'));
        // dd($request->session()->put(['email'=> $request->email, 'password'=> md5($request->password).$salt_password->salt_password]));
            // dd(Auth::attempt(['email'=> $request->email, 'password'=> md5($request->password).$salt_password->salt_password]));
            // ['email'=> $request->email, 'password'=> md5($request->password).$salt_password->salt_password]
            // dd(md5($request->password).$salt_password->salt_password);

        $salt_password = User::select('salt_password')->where('email',  $request->email)->first();
            $pass =md5($request->password).$salt_password->salt_password;
            $passdb =User::select('password')->where('email', $request->email)->first();
        if ($pass == $passdb->password){
            // $user = Auth::user();
            // $success['nama']= $user->nama;
            // $success['email']= $user->email;
            // $success = $request->session()->put('email', 'tes');
            $success = $request->session()->put('email', $request->email);
            return response()->json([
                'success' => true,
                'message'=>'login sukses',
                'data' => $success
            ]);
            // $request->session()->regenerate();
        }else{
            return response()->json([
                'success' => false,
                'message'=>'login gagal',
                'data' =>null
            ]);

        }

           // $request->validate([

        //     'email' =>'required',
        //     'password' =>'required'
        // ]);
        //   $credentials = $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required'
        // ]);
        // $userr = Auth::user();
        // dd($userr);
        // $user = User::where('email', $request->email)->first();
        // dd(User::get()->email);

        // $validator = Validator::make($request->all(), [
        //     'email' => 'required|email',
        //     'password' => 'required'
        // ]);

        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 400);
        // }
        // $user = User::where('email', $request->email)->first();

        // if (!$user || !Hash::check($request->password, $user->password)) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Login Failed!',
        //     ]);
        // }

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Login Success!',
        //     'data'    => $user,
        //     'token'   => $user->createToken('authToken')->accessToken
        // ]);

        // $user = User::where('email', $request->email)->first();
        // $user = $user->find(Auth::user()->id);
        // return response()->json(['data' =>[
        //     'user'=>$user

        //     ]]);
    }
}
