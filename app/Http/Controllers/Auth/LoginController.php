<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

public function login(Request $request)
{
    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (!Auth::attempt($request->only('email', 'password'))) {
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    $request->session()->regenerate();

    $role = Auth::user()->role?->name;

    return match ($role) {
        'admin'   => redirect('/admin'),
        'cashier' => redirect('/cashier'),
        'chef'    => redirect('/chef'),
        default   => redirect('/'),
    };
}


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
