<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang_User extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $primaryKey = 'keranjang_user_id';
    protected $table ='keranjang_user';
    protected $fillable = [
        'user_id',
        'toko_id',
        'barang_id',
        'kategori_id',
        'varian_id',
        'kuantitas',
    ];

    public function KeranjangUser(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function keranjangVarian(){
        return $this->belongsTo(Varian::class, 'varian_id');
    }
    public function KeranjangBarang(){
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
