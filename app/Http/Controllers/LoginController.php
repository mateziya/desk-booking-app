<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function create()
    {
        return Inertia::render('Login', [
            'status' => session('status')
        ]);
    }
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->route('calendar');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match.'
        ])->onlyInput('email');
    }
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
