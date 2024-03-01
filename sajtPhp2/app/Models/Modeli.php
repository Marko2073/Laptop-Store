<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modeli extends Model
{
    protected $table = 'models';
    use HasFactory;
    public function brand(){
        return $this->belongsTo(Brand::class);

    }
    public function modelSpecs(){
        return $this->hasMany(ModelSpec::class);
    }
}
