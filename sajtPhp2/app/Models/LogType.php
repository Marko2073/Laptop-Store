<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogType extends Model
{
    use HasFactory;

    protected $table = 'log_type';

    public function logs()
    {
        return $this->hasMany(Log::class);
    }
}
