<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Varian extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $primaryKey = 'varian_id';
    protected $table ='varian';
    protected $fillable = [
        'barang_id',
        'nama',
        'harga',
        'stok',
    ];
    public function VarianBarang(){
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
