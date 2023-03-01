<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Toko;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TokoUserController extends Controller
{

    public function getbarangbytokouser(Request $request, $id){
        $data= Toko::where('user_id', $id)->get();
        foreach ($data as $key=> $dt) {
            $data[$key]['barang']=$dt->Barang;

       }
        return response()->json($data);
    }

    public function createtoko(Request $request, $id){
        $user = $id;
        $validatedData = $request->validate([
            'user_id'=>'',
            'nama'=> '',
            'deskripsi' => '',
            'alamat'=> '',
            'no_telepon'=> '',
            'logo' =>'',
        ]);

        $validatedData['user_id'] = $user;
        // if($request->file('logo')){

        //     $validatedData['logo'] =  $request->file('logo')->store('logotoko');
        // }
        // dd($validatedData['user_id']);
        Toko::create($validatedData);
    }

    public function updatetoko(Request $request, $id ){
        // $data = Toko::where('toko_id', $id)->update([
        //     // "id" => $request->id,
        //     "nama" => $request->nama,
        //     "deskripsi" => $request->deskripsi,
        //     "alamat" => $request->alamat,
        //     "no_telepon" => $request->no_telepon,
        //     "logo" => $request->logo
        // ]);
        $rules = [
            'nama'=>'',
            'deskripsi'=>'',
            'alamat'=>'',
            'no_telepon'=>'',
            'logo'=>''
        ];
        $validasi = $request->validate($rules);

        if($request->file('logo')) {
            // dd($request->oldImage);
            if(!empty(Toko::find($id)->logo)) {
                Storage::delete(Toko::find($id)->logo);
            }
            $validasi['logo'] = $request->file('logo')->store('logotoko');
        }
        $data = Toko::where('toko_id', $id)->update($validasi);

        return response()->json($data, 200);
    }
        public function deletetoko($id ){
            // $data = Toko::find($id);
            if(!empty(Toko::find($id)->logo)) {
                Storage::delete(Toko::find($id)->logo);
            }
            $data = Toko::where('toko_id', $id);

            // $data->Barang()->delete();
            $data->delete();

            return response()->json($data, 200);
        }
}
