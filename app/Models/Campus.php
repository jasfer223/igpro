<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campus extends Model
{
    use HasFactory;

    protected $fillable = ['location'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'campus_id');
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'campus_project', 'campus_id', 'project_id')
                    ->withPivot('status_id');
    }


}
