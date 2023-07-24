<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class AdminController extends Controller
{
    public function showAdminDashboard(){
     
        return view('admin.dashboard');
    }

     public function adminLogout(){
        return redirect(route('login'));
    }

    public function showUsers(){
         $usersWithRoles = User::with('roles')->get(); // Query all users with their showRoles
         $roles = Role::get(); // Query all role value

        return view('admin.users', compact('usersWithRoles', 'roles'));

    }

    public function showCampus(){
        return view('admin.campuses');
    }
    public function showRoles(){
        return view('admin.roles');
    }

}
