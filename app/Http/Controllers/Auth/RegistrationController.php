<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Services\RegistrationService;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    private $registrationService;

    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }
    public function ShowRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(RegistrationRequest $request)
    {
        $newUser = $this->registrationService->register($request);
        return redirect(route('userPage'));
    }

}
