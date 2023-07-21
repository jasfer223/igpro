<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuccessIndicator extends Model
{
    use HasFactory;

    protected $fillable = ['description'];
    // ONE TO MANY
    // Get the campus that relate to the user
    public function accomplishmentReport(){
        return $this->belongsTo(AccomplishmentReport::class);
    }
}
