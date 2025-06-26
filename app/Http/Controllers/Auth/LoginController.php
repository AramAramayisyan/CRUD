<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\LoginService;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    private $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }
    public function showLoginForm() : object // show login form
    {
        if (Auth::user()) {

            return redirect('profile/my');
        }

        return view('auth.login');
    }

    public function login(LoginRequest $request) : object // login
    {
        if (Auth::user()) {

           return redirect('profile/my');
        }
        if ($this->loginService->login($request)) {

            return redirect('profile/my');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    public function logout() : object // logout
    {
        if (auth()->logout()) {

            return redirect('/');
        }

        return redirect('profile/my');
    }
}
