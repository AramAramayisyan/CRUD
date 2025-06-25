<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\editPassRequest;
use App\Http\Requests\UserRequest;
use App\Mail\TestMail;
use App\Models\Product;
use App\Models\User;
use App\Services\ProductService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    private $userService;
    private $productService;

    public function __construct(UserService $userService, ProductService $productService)
    {
        $this->userService = $userService;
        $this->productService = $productService;
    }

    public function myProfile()
    {
        return view('auth.my_profile');
    }

    public function editProfile()
    {
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
        return view('auth.my_profile_edit');
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

    public function deleteProfile(Request $request)
    {
        $user = Auth::user();
        $avatar = $user->avatar;
        Auth::logout();
        if ($user->forceDelete() && $avatar && $avatar != 'avatars/default/default.jpg') {
            Storage::disk('public')->delete($avatar);
        }

        return view('auth.login');
    }

    public function show($id)
    {
        $user = $this->userService->show($id);
        return view('auth.profile', compact('user'));
    }

    public function products(User $user)
    {
        $data['products'] = $user->products;
        $data['types'] = $user->productsWithTypes->pluck('type')->unique('id');

        return view('index', compact('data'));
    }
}
