<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampusProject extends Model
{
    use HasFactory;

    protected $fillable = ['project_id','campus_id','status'];

    // ONE TO MANY
    // Get the campus that relate to the user
    public function accomplishmentReport(){
        return $this->belongsTo(AccomplishmentReport::class);
    }


    // MANY TO ONE
    public function campuses(){
        return $this->hasMany(Campus::class);
    }

    // MANY TO ONE
    public function projects(){
        return $this->hasMany(Project::class);
    }
}