<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = ['status_name'];


    public function projects()
    {
        return $this->belongsToMany(Project::class, 'campus_project', 'status_id', 'project_id')
            ->withPivot('campus_id');
    }

    public function campuses() {
        return $this->belongsToMany(Campus::class, 'campus_project', 'status_id', 'campus_id')
            ->withPivot('project_id');
    }


}
