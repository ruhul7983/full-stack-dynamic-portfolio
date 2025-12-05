<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // If user not logged in
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // If user is not admin
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')
                ->with('error', 'Access denied. You must be an administrator.');
        }

        // Allow request
        return $next($request);
    }
}
