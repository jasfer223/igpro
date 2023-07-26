<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (auth()->check()) {
            
            if(auth()->user()->isAdmin()) {
                // If the user is already authenticated, redirect to the admin dashboard.
                return redirect()->route('admin.dashboard');
            }

            // If the user is already authenticated, redirect to the user dashboard.
            return redirect()->route('user.dashboard');
        }
        return $next($request);
    }
}
