<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    use HasFactory;

    protected $guarded = [];

    //Get user on specific campus
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
