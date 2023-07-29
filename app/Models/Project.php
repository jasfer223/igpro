<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Project extends Model
{
    use HasFactory;
    
    protected $fillable = ['title','description','user_id'];


    // MANY TO MANY
    public function campuses(){
        return $this->belongsToMany(Campus::class, 'campus_project', 'project_id', 'campus_id')
            ->withPivot('status_id'); 
    }

    // MANY TO ONE 
    public function users(){
        return $this->belongsTo(User::class);
    }


    public function statuses() {
        return $this->belongsToMany(Status::class, 'campus_project', 'project_id', 'status_id')
            ->withPivot('campus_id');
    }


}
