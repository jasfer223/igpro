<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function redirectToLogin() {
        return redirect()->route('login');
    }
}