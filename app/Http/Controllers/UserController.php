<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Role;
use App\Models\User;
use App\Models\Project;



class UserController extends Controller
{

    public function showLogin()
    {
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
        // Get the authenticated user's campus location
        $userLocation = Auth::user()->campus->location;

        // Fetch only the campusProjects that belong to the user's campus location
        $campusProjects = Project::whereHas('campuses', function ($query) use ($userLocation) {
            $query->where('location', $userLocation);
        })
            ->with(['campuses' => function ($query) use ($userLocation) {
                $query->where('location', $userLocation);
            }])
            ->get();

        // return $campusProjects;
        // Extract the filtered statuses from the campusProjects
        $filteredStatuses = $campusProjects->pluck('statuses')->flatten();
        //return $filteredStatuses;
        return view('user.projects', compact('campusProjects', 'filteredStatuses'));
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
}
