<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $primaryKey = 'transaksi_id';
    protected $table ='transaksi';
    protected $fillable = [
        'transaksi_id',
        'user_id',
        'toko_id',
        'barang_id',
        'varian_id',
        'kategori_id',
        'admin_konfirmasi',
        'status',
        'jumlah',
        'total_harga',
    ];

    public function transaksiUser(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function transaksiToko(){
        return $this->belongsTo(Toko::class, 'toko_id');
    }
    public function transaksiBarang(){
        return $this->belongsTo(Barang::class, 'barang_id');
    }
    public function transaksiVarian(){
        return $this->belongsTo(Varian::class, 'varian_id');
    }
    public function transaksiKategori(){
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
    public function transaksiFotoBarangFirst(){
        return $this->belongsTo(Foto_Barang::class, 'barang_id', 'barang_id')->limit(1);
    }
}
