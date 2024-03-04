<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelSpec extends Model
{
    protected $table = 'model_specification';
    use HasFactory;
    public function specifications(){
        return $this->belongsToMany(Specification::class);
    }
    public function model(){
        return $this->belongsTo(Modeli::class);
    }
    public function price(){
        return $this->hasMany(Price::class);
    }
    public function purchases(){
        return $this->hasMany(Purchase::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
