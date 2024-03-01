<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $table = 'purchases';
    protected $fillable = [
        'user_cart_id',
        'model_spec_id',
        'quantity',
        'payment_method'
    ];
    public function user_cart(){
        return $this->belongsTo(User_cart::class);
    }
    public function model_spec(){
        return $this->belongsTo(ModelSpec::class);
    }



}
