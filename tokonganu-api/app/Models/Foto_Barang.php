<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto_Barang extends Model
{
    use HasFactory;
    public $timestamps= false;
    protected $primaryKey = 'foto_barang_id';
    protected $table ='foto_barang';
    protected $fillable = [
        'barang_id',
        'file',
    ];
    public function FotoBarang(){
        return $this->belongsTo(Barang::class, 'barang_id');
    }
    // public function FotoVarian(){
    //     return $this->belongsTo(Varian::class, 'foto_barang_id');
    // }
}
