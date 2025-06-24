<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Services\RegistrationService;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    private $registrationService;

    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    public function showRegistrationForm()
    {
        if (Auth::user()) {
            return redirect('profile/my');
        }
        return view('auth.register');
    }

    public function register(RegistrationRequest $request)
    {
        if (Auth::user()) {
            return redirect('profile/my');
        }
        if ($this->registrationService->register($request)) {
            return redirect('profile/my');
        }
        return view('auth.register');
    }
}
