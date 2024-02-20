<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        \Log::info('User in StudentMiddleware: ' . json_encode($user));
        //dd($user, $request->url());
        if  ($request->user() && $request->user()->is_admin == 3){
            return $next($request);
        }
    
        abort(403, 'Unauthorized action.');
    }
    
}

