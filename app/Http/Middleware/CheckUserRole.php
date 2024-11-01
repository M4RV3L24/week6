<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        echo "Page permission needed: ".$role,", User permission: ".$request->user()->role->name;
        if (!Auth::check())
            return redirect()->route('login');

        /**
         * For checking try accessing URL http://localhost:8000/walks/create without login, comment the auth check above first
         */
        if ($request->user()->role->name != $role) {
            if ($role == 'admin') {
                // return redirect()->route('walks.index');
                // Add process or session needed when opening pages with admin permission
            } else if ($role == 'walker') {
                return redirect()->route('walks.index');
                // Add process or session needed when opening pages with walker permission
            }
    
        }

        return $next($request);
    }
}
