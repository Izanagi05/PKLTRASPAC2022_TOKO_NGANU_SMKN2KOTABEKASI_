<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $primaryKey = 'rating_id';
    protected $table ='rating';
    protected $fillable = [
        'user_id',
        'barang_id',
        'rating',
    ];
    public function RatingUser(){
        return $this->hasMany(User::class, 'user_id');
    }
    public function RatingBarang(){
        return $this->hasMany(Barang::class, 'barang_id');
    }
}
