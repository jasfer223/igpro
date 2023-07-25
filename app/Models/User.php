<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['username', 'email', 'password', 'campus_id'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //  MANY TO MANY
    public function roles(){
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    // ONE TO MANY
    // Get the campus that relate to the user
    public function campus(){
        return $this->belongsTo(Campus::class);
    }

    // MANY TO ONE
    // Get the USERS PROJECTS
    public function projects(){
        return $this->hasMany(Project::class);
    }


    public function isAdmin()
    {
        // Check if the user has the 'Admin' role
        return $this->roles()->where('role_name', 'Admin')->exists();
    }

    public function hasAnyRole(...$roles)
    {
        // Check if the user has the any of the role
        return $this->roles()->whereIn('role_name', $roles)->exists();
    }
}
