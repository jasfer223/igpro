<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    use HasFactory;

    protected $fillable = ['location'];

    //Get users on specific campus
    public function users()
    {
        return $this->hasMany(User::class);
    }


    public function projects(){
        return $this->belongsToMany(Project::class, 'campus_project', 'project_id', 'campus_id')
            ->withPivot('status_id');;
    }

    public function statuses() {
        return $this->belongsToMany(Status::class, 'campus_project', 'campus_id', 'status_id')
        ->withPivot('project_id');
    }

}
