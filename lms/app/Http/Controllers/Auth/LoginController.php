<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            if (auth()->user()->is_admin == 1) {
                return redirect()->intended($this->redirectTo);
            } elseif (auth()->user()->is_admin == 2) {
                return redirect()->route('teacher.dashboard');
            } elseif (auth()->user()->is_admin == 3) {
                return redirect()->route('student.dashboard');
            } else {
                return redirect()->route('login')->with('error', 'You are not authorized to access this page.');
            }
        }
        
    
        return redirect()->back()->withInput($request->only('email'));
    }
}
