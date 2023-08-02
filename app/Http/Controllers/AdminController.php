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
        $campusStatusData = [];
        foreach ($campuses as $campus) {
            $projectCount = Project::whereHas('campuses', function ($query) use ($campus) {
                $query->where('campus_id', $campus->id);
            })->count();

            // Get count of functional status on each campus
            $functionalProjectsCount = $campus->projects()->wherePivot('status_id', Status::where('status_name', 'Functional')->value('id'))->count();

            // Get count of phasedout status on each campus
            $phasedoutProjectsCount = $campus->projects()->wherePivot('status_id', Status::where('status_name', 'Phased Out')->value('id'))->count();

            $campusData[] = [
                'location' => $campus->location,
                'projects_count' => $projectCount,
            ];

            $campusStatusData[] = [
                'location' => $campus->location,
                'functional_projects_count' => $functionalProjectsCount,
                'phased_out_projects_count' => $phasedoutProjectsCount,
            ];
        }

        // dd($campusStatusData);

        // $projectsLenght = YourModel::count();
        return view('admin.dashboard', [
            'usersCount' => $usersCount,
            'campusesCount' => $campusesCount,
            'rolesCount' => $rolesCount,
            'adminsCount' => $adminsCount,
            'projectsCount' => $projectsCount,
            'campusData' => $campusData,
            'campusStatusData' => $campusStatusData,
        ]);
    }

    public function adminLogout()
    {
        Auth::logout();
        return redirect(route('login'));
    }

    public function showUsers()
    {
        $usersWithRoles = User::with('roles')->get(); // Query all users with their showRoles
        $roles = Role::get(); // Query all role value
        $campuses = Campus::get(); // Query all campus value

        return view('admin.users', compact('usersWithRoles', 'roles', 'campuses'));
    }

    public function showCampus()
    {
        $campuses = Campus::get(); // Query all campus value
        return view('admin.campuses', compact('campuses'));
    }
    public function showRoles()
    {
        $roles = Role::get(); // Query all role value
        return view('admin.roles', compact('roles'));
    }

    public function createUser(Request $request)
    {

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

        if ($user) {
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

    public function createCampus(Request $request)
    {
        $request->validate([
            'location' => 'required|unique:campuses',
        ]);

        // Create the campus
        $campus = Campus::create([
            'location' => $request->input('location'),
        ]);

        if ($campus) {

            // Set a flash message to indicate success
            session()->flash('success', 'Campus created successfully!');
        } else {
            // Set a flash message to indicate error
            session()->flash('error', 'Error creating campus.');
        }

        return redirect()->route('admin.campuses');
    }

    public function createRole(Request $request)
    {
        $request->validate([
            'role_name' => 'required|unique:roles',
        ]);

        // Create the role
        $role = Role::create([
            'role_name' => $request->input('role_name'),
        ]);

        if ($role) {

            // Set a flash message to indicate success
            session()->flash('success', 'Campus created successfully!');
        } else {
            // Set a flash message to indicate error
            session()->flash('error', 'Error creating campus.');
        }

        return redirect()->route('admin.roles');
    }

    public function showProjects()
    {
        // Fetch all projects with their related campuses and statuses
        $statuses = Status::all();
        $projects = Project::all();
        $campuses = Campus::all();
        return view('admin.projects', compact('projects', 'statuses', 'campuses'));
    }

    public function createProject(Request $request)
    {    

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'campuses' => 'required|array|min:1', // Check that at least one campus is selected
            'campuses.*' => 'exists:campuses,id', // Check that the selected campus IDs exist in the 'campuses' table
            // Add validation rules for the status dropdowns
            // We use "status_{campus_id}" as the input name format for the status dropdowns
            // For each selected campus, the corresponding status dropdown should be required and must exist in the 'statuses' table
            'status_*' => 'required|exists:statuses,id',
        ]);

        // Create the project
        $projectData = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ];

        // Save the project data to the 'projects' table
        $project = Auth::user()->projects()->create($projectData);

        // Prepare an array to associate campuses and their statuses with the project
        $campusStatusData = [];

        // Get the selected campus IDs from the request
        $selectedCampusIds = $request->input('campuses');

        // Loop through the selected campuses and associate their corresponding statuses with the project
        foreach ($selectedCampusIds as $campusId) {
            $statusId = $request->input('status_' . $campusId);

            // Validate that the selected status is valid
            // You may want to add additional validation here if needed
            $statusExists = Status::where('id', $statusId)->exists();

            if ($statusExists) {
                // Add the campus ID and status ID to the array
                $campusStatusData[$campusId] = ['status_id' => $statusId];
            }
        }

        // Save the campus-status associations to the 'campus_project' table
        $project->campuses()->attach($campusStatusData);
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
