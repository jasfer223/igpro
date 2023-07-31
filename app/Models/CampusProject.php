<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CampusProject extends Pivot
{
    use HasFactory;

    protected $table = 'campus_project';

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
