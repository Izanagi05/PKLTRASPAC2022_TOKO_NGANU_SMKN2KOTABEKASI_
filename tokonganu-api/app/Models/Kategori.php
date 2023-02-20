<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $primaryKey = 'kategori_id';
    protected $table ='kategori';
    protected $fillable = [
        'nama',
    ];

    public function Barang(){
        return $this->hasMany(Barang::class);
    }
}
