<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'transaksi_id';
    protected $table ='transaksi';
    protected $fillable = [
        'user_id',
        'total_transaksi',
    ];
    public function transaksiUser(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
