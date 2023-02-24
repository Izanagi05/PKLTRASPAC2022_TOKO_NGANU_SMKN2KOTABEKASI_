<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // public $timestamps = false;
    protected $primaryKey = 'id';
    // public $table ='users';
    protected $table ='user';
    protected $fillable = [
        'email',
        'role_id',
        'password',
        'salt_password',
        'nama',
        'no_telepon',
        'foto_profil',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */


    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function RoleUser(){
        return $this->belongsTo(Role::class, 'role_id');
    }
    public function UserToko(){
        return $this->hasMany(Toko::class);
    }
    public function UserAlamat(){
        return $this->hasMany(Alamat_User::class);
    }
    public function UserKeranjang(){
        return $this->hasMany(Keranjang_User::class);
    }
    public function UserBarang(){
        return $this->hasMany(Barang::class);
    }
}
