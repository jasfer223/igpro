<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccomplishmentReport extends Model
{
    use HasFactory;

    protected $fillable = ['campus_project_id','success_indicator_id','target','quantity','quantity_remarks','percentage','percentage_remarks'];

    // MANY TO ONE
    // Get the USERS PROJECTS
    public function campusProjects(){
        return $this->hasMany(CampusProject::class);
    }


    // MANY TO ONE
    // Get the USERS PROJECTS
    public function successIndicators(){
        return $this->hasMany(SuccessIndicators::class);
    }


}
