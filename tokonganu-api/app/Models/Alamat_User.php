<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat_User extends Model
{
    use HasFactory;
    protected $primaryKey = 'alamat_user_id';
    protected $table ='alamat_user';
    protected $fillable = [
        'alamat',
    ];
    public function AlamatUser(){
        return $this->belongsTo(User::class, 'user_id');

    }




}
