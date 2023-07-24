<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function showAdminDashboard(){
        return view('admin.dashboard');
    }

     public function adminLogout(){
        return redirect(route('login'));
    }

    public function showUsers(){
        return view('admin.users');
    }

    public function showCampus(){
        return view('admin.campuses');
    }
    public function showRoles(){
        return view('admin.roles');
    }

}
