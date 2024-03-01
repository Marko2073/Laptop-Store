<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit_card extends Model
{
    use HasFactory;
    protected $fillable = [
        'card_number',
        'expiration_date',
        'cvv',
        'card_name',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
