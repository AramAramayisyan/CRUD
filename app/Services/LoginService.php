<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class LoginService
{
    public function login($request)
    {
        if (Auth::attempt(['emails' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return true;
        }
        return back()->withErrors([
            'emails' => 'The provided credentials do not match our records.',
            'password' => 'The provided credentials do not match our records.',
        ]);
    }
}
