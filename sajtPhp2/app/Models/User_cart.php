<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_cart extends Model
{
    use HasFactory;
    protected $table = 'user_cart';
    protected $fillable = [
        'user_id',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function purchase(){
        return $this->hasMany(Purchase::class);
    }
}
