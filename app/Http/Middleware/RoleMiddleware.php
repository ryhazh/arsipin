<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('loginpage')->with('error', 'Please login first');
        }

        $userRoleId = DB::table('roles')->where('name', 'admin')->first()->id;
        
        if (Auth::user()->role_id !== $userRoleId) {
            return redirect()->back()->with('error', 'Unauthorized access');
        }

        return $next($request);
    }
}
