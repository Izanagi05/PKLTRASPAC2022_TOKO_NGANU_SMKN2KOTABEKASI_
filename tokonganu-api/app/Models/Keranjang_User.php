<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang_User extends Model
{
    use HasFactory;
    protected $primaryKey = 'keranjang_user_id';
    protected $table ='keranjang_user';
    protected $fillable = [
        'kuantitas',
    ];

    public function KeranjangUser(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function KeranjangBarang(){
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
