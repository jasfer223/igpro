<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title','description','user_id'];


    // MANY TO MANY
    public function campuses(){
        return $this->belongsToMany(Campus::class);
    }

    // MANY TO ONE 
    public function users(){
        return $this->hasMany(User::class);
    }
}
