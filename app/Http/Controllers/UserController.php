<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{

    public function index() {
       //
    }

    public function showLogin(){
         // $usersWithRoles = User::with('roles')->get();
        // return view('login', compact('usersWithRoles'));
        return view('login');
    }

    public function showDashboard(){
        return view('user.dashboard');
    }

    

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
       
        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)) {
            $user = Auth::user();


            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        }

        return redirect()->route('login')->withErrors(['message' => 'Invalid login credentials.']);
    }

    public function logout(){
          Auth::logout();

        // You can add any additional logic you want after the user is logged out.

        // For example, you can redirect the user to a specific page after logout.
        return redirect()->route('login');
    }

}
