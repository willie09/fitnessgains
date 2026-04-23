<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
            // If not authenticated, redirect to login
            return redirect()->route('login');
        }

        // Get the authenticated user
        $user = Auth::user();

        // Check if user is admin
        if ($user->isAdmin()) {
            // Allow access for admin users
            return $next($request);
        }

        // If user is a trainor, redirect to trainor dashboard
if ($user->isTrainor()) {
    return redirect()->route('trainor.dashboard');
}

        // If user is a member, redirect to member portal
        if ($user->isMember()) {
            return redirect()->route('member-portal');
        }

        // For any other role or case, redirect to home
        return redirect('/');
    }
}
