<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    use HasFactory;
    protected $primaryKey = 'toko_id';
    protected $table ='toko';
    protected $fillable = [
        'nama',
        'alamat',
        'deskripsi',
        'no_telepon',
        'logo',
        'transaksi_terakhir',
    ];
    public function Barang(){
        return $this->hasMany(Barang::class);
    }
    public function TokoUser(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
