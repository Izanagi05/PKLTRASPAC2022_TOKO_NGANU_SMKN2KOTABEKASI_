<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $primaryKey = 'role_id';
    protected $table ='role';
    protected $fillable = [
        'nama'
    ];

    public function User(){
        return $this->hasMany(User::class);
    }
}
