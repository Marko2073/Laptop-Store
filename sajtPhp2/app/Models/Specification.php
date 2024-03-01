<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    protected $table = 'specifications';
    use HasFactory;

    public function modelspec(){
        return $this->belongsToMany(ModelSpec::class);
    }


}
