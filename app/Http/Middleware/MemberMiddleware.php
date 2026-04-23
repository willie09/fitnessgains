<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class MemberMiddleware
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

        // Check if user is a member
        if ($user->isMember()) {
            // Allow access for member users
            return $next($request);
        }

        // If user is an admin, redirect to dashboard
        if ($user->isAdmin()) {
            return redirect()->route('dashboard');
        }

        // For any other role or case, redirect to home
        return redirect('/');
    }
}
