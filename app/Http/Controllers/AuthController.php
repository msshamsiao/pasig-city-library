<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        $error = session('error');
        return view('auth.login', compact('error'));
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Check if the authenticated user is an admin
            if (Auth::user()->admin == 1 || Auth::user()->admin == 2) {
                return redirect()->route('admin.dashboard');
            }

            if (Auth::user()->admin == 0) {
                return redirect()->route('admin.user_transaction');
            }

            // For regular users, you can redirect to a different route or the default '/dashboard'
            return redirect()->intended('/dashboard');
        }

        // Authentication failed
        return view('auth.login')->with('error', 'Invalid credentials');
    }
}
