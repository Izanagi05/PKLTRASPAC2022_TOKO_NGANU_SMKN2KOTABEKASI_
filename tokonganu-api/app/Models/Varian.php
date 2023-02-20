<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Varian extends Model
{
    use HasFactory;
    protected $primaryKey = 'varian_id';
    protected $table ='varian';
    protected $fillable = [
        'nama',
        'harga',
        'stok',
    ];
    public function VarianBarang(){
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
