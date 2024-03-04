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


    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone',
        'address',
        'city',
        'password',
        'role_id',
    ];




    public function roles(){
        return $this->belongsTo(Role::class);
    }

    public function credit_cards(){
        return $this->hasMany(Credit_card::class);
    }
    public function usercarts(){
        return $this->hasMany(User_cart::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }

}
