<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Role;
use App\Models\User;
use App\Models\Project;
use App\Models\Status;

class UserController extends Controller
{

    public function showLogin()
    {
        // $campus = [
        //     'location' => 'Tandag',
        // ];
        // Campus::create($campus);
        
        // $user = [
        //     'username' => 'igpro',
        //     'email' => 'igpro@nemsu.edu.ph',
        //     'password' => '12345678',
        //     'campus_id' => 1,
        // ];
        // User::create($user);

        // $role = [
        //     'role_name' => 'Admin',
        // ];
        // Role::create($role);

        // $user = User::find(1);
        // $role = Role::find(1);
        // $user->roles()->attach($role);

        // $status = [
        //     'status_name' => 'Phased Out',
        // ];
        // Status::create($status);

        if (Auth::check()) {
            return redirect()->route('user.dashboard');
        }

        return view('login');
    }

    public function showDashboard()
    {
        return view('user.dashboard');
    }

    public function showProjects()
    {
        // Fetch all projects with their related campuses and statuses
        $statuses = Status::all();
        $projects = Project::all();
        $campuses = Campus::all();
        return view('user.projects', compact('projects', 'statuses', 'campuses'));
    }


    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        }

        return redirect()->route('login')->withErrors(['message' => 'Invalid login credentials.']);
    }

    public function userLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function createProject(Request $request)
    {    
        dd($request);
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

        return redirect()->route('user.projects');
    }
}
