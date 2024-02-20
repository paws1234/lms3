<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class TeacherMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($request->user() && $request->user()->is_admin == 2) {
            return $next($request);
        }

        return redirect('login')->with('error', 'You do not have permission to access this page.');
    }
}