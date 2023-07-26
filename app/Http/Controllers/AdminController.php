<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Campus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showAdminDashboard(){
        $usersCount = User::count();
        $campusesCount = Campus::count();
        $rolesCount = Role::count();


        // $projectsLenght = YourModel::count();
        return view('admin.dashboard', [
            'usersCount' => $usersCount,
            'campusesCount' => $campusesCount,
            'rolesCount' => $rolesCount,
        ]);
    }

    public function adminLogout(){
        Auth::logout();
        return redirect(route('login'));
    }

    public function showUsers(){
         $usersWithRoles = User::with('roles')->get(); // Query all users with their showRoles
         $roles = Role::get(); // Query all role value
         $campuses = Campus::get(); // Query all campus value

        return view('admin.users', compact('usersWithRoles', 'roles', 'campuses'));

    }

    public function showCampus(){
        $campuses = Campus::get(); // Query all campus value
        return view('admin.campuses', compact('campuses'));
    }
    public function showRoles(){
        $roles = Role::get(); // Query all role value
        return view('admin.roles', compact('roles'));
    }

    public function createUser(Request $request){

        $request->validate([
            'role' => 'required',
            'campus' => 'required',
            'username' => 'required|min:4',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed|max:20',
        ]);


        // Check if password and password_confirmation match
        // if ($request->input('password') !== $request->input('password_confirmation')) {
        //     // Set a flash message to indicate password mismatch
        //     session()->flash('error', 'Passwords do not match.');
        //     return back()->withInput();
        // }

        // Create the user
        $user = User::create([
                'campus_id' => $request->input('campus'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),    
        ]);

        if($user) {
            // Attach the role to the user in the pivot table
            $user->roles()->attach($request->input('role'));

            // Set a flash message to indicate success
            session()->flash('success', 'User created successfully!');
        } else {
            // Set a flash message to indicate error
            session()->flash('error', 'Error creating user.');
        }

        return redirect()->route('admin.users');
    }

    public function createCampus(Request $request){
        $request->validate([
            'location' => 'required|unique:campuses',
        ]);

        // Create the campus
        $campus = Campus::create([
                'location' => $request->input('location'),
        ]);

        if($campus) {

            // Set a flash message to indicate success
            session()->flash('success', 'Campus created successfully!');
        } else {
            // Set a flash message to indicate error
            session()->flash('error', 'Error creating campus.');
        }

        return redirect()->route('admin.campuses');

    }

    public function createRole(Request $request){
        $request->validate([
            'role_name' => 'required|unique:roles',
        ]);

        // Create the role
        $role = Role::create([
                'role_name' => $request->input('role_name'),
        ]);

        if($role) {

            // Set a flash message to indicate success
            session()->flash('success', 'Campus created successfully!');
        } else {
            // Set a flash message to indicate error
            session()->flash('error', 'Error creating campus.');
        }

        return redirect()->route('admin.roles');

    }
}
