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
    public function showLoginForm()
    {
        if (Auth::user()) {
            return redirect('/user');
        }
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        if (!Auth::user()) {
            if ($this->loginService->login($request)) {
                return redirect('/user');
            }
        }
        return redirect('/user');
    }

    public function showUserPage()
    {
        return view('auth.user');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}
