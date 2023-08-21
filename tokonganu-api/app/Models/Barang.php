<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $primaryKey = 'barang_id';
    protected $table ='barang';
    protected $fillable = [
        'nama',
        'toko_id',
        'kategori_id',
        'deskripsi',
    ];
    public function Toko(){
        return $this->belongsTo(Toko::class, 'toko_id');
    }
    public function Kategori(){
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
    public function BarangFoto(){
        return $this->hasMany(Foto_Barang::class, 'barang_id');
    }
    // public function BarangKeranjang(){
    //     return $this->hasMany(Keranjang_User::class);
    // }
    public function barangVarian(){
        return $this->hasMany(Varian::class, 'barang_id');
    }
    public function barangVarianFirst(){
        return $this->hasMany(Varian::class, 'barang_id')->limit(1);;
    }
    public function barangFotoFirst(){
        return $this->hasMany(Foto_Barang::class, 'barang_id')->limit(1);;
    }
}
