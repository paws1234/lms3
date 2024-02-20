<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->is_admin == 1) {
            return $next($request);
        }

        return redirect('login')->with('error', 'You do not have admin privileges.');
    }
}
