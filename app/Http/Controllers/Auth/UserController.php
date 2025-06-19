<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\editPassRequest;
use App\Http\Requests\UserRequest;
use App\Services\UserService;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function myProfile()
    {
        return view('auth.my_profile');
    }

    public function editProfile() {
        return view('auth.my_profile_edit');
    }

    public function updateProfile(UserRequest $request)
    {
        if ($this->userService->updateProfile($request)) {
            return redirect('profile/my');
        }
    }

    public function editPassword(editPassRequest $request)
    {
        if ($this->userService->updatePassword($request)) {
            return redirect('profile/my');
        }
    }
}
