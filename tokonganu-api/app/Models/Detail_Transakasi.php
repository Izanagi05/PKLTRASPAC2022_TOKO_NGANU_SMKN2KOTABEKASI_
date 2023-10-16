<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Transakasi extends Model
{
    use HasFactory;
    protected $primaryKey = 'detail_transaksi_id';
    protected $table ='detail_transakasi';
    protected $fillable = [
        'user_id',
        'toko_id',
        'barang_id',
        'kategori_id',
        'varian_id',
        'transaksi_id',
        'status',
        'admin_konfirmasi',
        'jumlah',
        'subtotal'
    ];


    public function detailTransaksiUser(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function detailTransaksiToko(){
        return $this->belongsTo(Toko::class, 'toko_id');
    }
    public function detailTransaksiBarang(){
        return $this->belongsTo(Barang::class, 'barang_id');
    }
    public function detailTransaksiVarian(){
        return $this->belongsTo(Varian::class, 'varian_id');
    }
    public function detailTransaksiKategori(){
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
