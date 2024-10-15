<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
    {
        if (!auth()->check()) {
            return redirect('/login'); // User is not logged in
        }
    
        if (auth()->user()->role !== $role) {
            return redirect('/'); // User does not have the correct role
        }
    
        return $next($request);
    }
    
}
