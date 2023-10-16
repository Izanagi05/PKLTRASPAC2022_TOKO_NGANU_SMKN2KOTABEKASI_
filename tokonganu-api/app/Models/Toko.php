<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $primaryKey = 'toko_id';
    protected $table ='toko';
    protected $fillable = [
        'nama',
        'user_id',
        'alamat',
        'deskripsi',
        'no_telepon',
        'logo',
        'transaksi_terakhir',
    ];
    public function Barang(){
        return $this->hasMany(Barang::class, 'toko_id');
    }
    public function TokoUser(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
