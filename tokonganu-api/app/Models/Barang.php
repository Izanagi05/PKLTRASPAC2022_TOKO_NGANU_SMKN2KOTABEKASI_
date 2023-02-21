<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $primaryKey = 'barang_id';
    protected $table ='barang';
    protected $fillable = [
        'nama',
        'deskripsi',
    ];
    public function Toko(){
        return $this->belongsTo(Toko::class, 'toko_id');
    }
    public function Kategori(){
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
    public function BarangFoto(){
        return $this->hasMany(Foto_Barang::class);
    }
    public function BarangKeranjang(){
        return $this->hasMany(Keranjang_User::class);
    }
    public function BarangVarian(){
        return $this->hasMany(Varian::class);
    }
}
