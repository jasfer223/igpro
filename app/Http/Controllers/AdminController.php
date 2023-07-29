<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\Models\Role;
use App\Models\User;
use App\Models\Campus;
use App\Models\Project;
use App\Models\Status;
use App\Models\CampusProject;

class AdminController extends Controller
{
    public function showAdminDashboard()
    {
        $usersCount = User::count();
        $campusesCount = Campus::count();
        $rolesCount = Role::count();
        $adminsCount = User::whereHas('roles', function ($query) {
            $query->where('role_name', 'Admin');
        })->count();
        $projectsCount = Project::count();

        // Get the count of projects in each campus
        $campuses = Campus::all();
        $campusData = [];
        foreach ($campuses as $campus) {
            $projectCount = Project::whereHas('campuses', function ($query) use ($campus) {
                $query->where('campus_id', $campus->id);
            })->count();

            $campusData[] = [
                'location' => $campus->location,
                'projects_count' => $projectCount,
            ];
        }

        // $projectsLenght = YourModel::count();
        return view('admin.dashboard', [
            'usersCount' => $usersCount,
            'campusesCount' => $campusesCount,
            'rolesCount' => $rolesCount,
            'adminsCount' => $adminsCount,
            'projectsCount' => $projectsCount,
            'campusData' => $campusData,
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

        public function showProjects() {
            // Fetch all projects with their related campuses and statuses
            $allStatus = Status::all();
            $campusProjects = Project::with('campuses', 'statuses')->get();
            $allCampus = Campus::all();

            return view('admin.projects', compact('campusProjects', 'allStatus', 'allCampus'));
        }

        public function createProject(Request $request) {
            // dd($request);    

            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'status' => 'required',
                'campus' => 'required',
            ]);


            // Create the project
            $project = Project::create([
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                    'user_id' => Auth::user()->id,
                
            ]);



            // Get the selected campus ID and status ID from the request
            $campusId = $request->input('campus');
            $statusId = $request->input('status');

            // Associate the project with the selected campus and status in the pivot table
            $project->campuses()->attach($campusId, ['status_id' => $statusId, 'project_id' => $project->id]);

            if ($project) {
                // Set a flash message to indicate success
                session()->flash('success', 'Project created successfully!');
            } else {
                // Set a flash message to indicate error
                session()->flash('error', 'Error creating project.');
            }

            return redirect()->route('admin.projects');
        }



}
