<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\editPassRequest;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

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
        return view('auth.my_profile_edit');
    }

    public function editPassword(editPassRequest $request)
    {
        if ($this->userService->updatePassword($request)) {
            return redirect('profile/my');
        }
        return view('auth.my_password_edit');
    }

    public function sendTestEmail()
    {
        $details = [
            'title' => 'Mail from Laravel',
            'body' => 'This is a test mail using Mailtrap'
        ];
        Mail::to('receiver@example.com')->send(new TestMail($details));
        return 'Mail Sent!';
    }
}
