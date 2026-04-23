<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class TrainorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Get the authenticated user
        $user = Auth::user();

        // Check if user is a trainor
        if ($user->role === 'trainor') {
            // Allow access for trainor users
            return $next($request);
        }

        // Redirect based on user role
        if ($user->isAdmin()) {
            return redirect()->route('dashboard');
        }

        if ($user->isMember()) {
            return redirect()->route('member-portal');
        }

        return redirect('/');
    }
}
