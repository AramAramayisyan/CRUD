<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\editPassRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Mail\TestMail;
use App\Models\User;
use App\Services\ProductService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    private $userService;
    private $productService;

    public function __construct(UserService $userService, ProductService $productService)
    {
        $this->userService = $userService;
        $this->productService = $productService;
    }

    public function myProfile(): object //Show user profile
    {
        return view('auth.my_profile');
    }

    public function editProfile(): object //show edit user profile
    {
        return view('auth.my_profile_edit');
    }

    public function updateProfile(UserRequest $request) : object //update user profile
    {
        if ($this->userService->updateProfile($request)) {

            return redirect('profile/my');
        }

        return redirect('profile/edit');
    }

    public function editPassword(editPassRequest $request) : object //update user password
    {
        if ($this->userService->updatePassword($request)) {

            return redirect('profile/my');
        }

        return redirect('profile/edit');
    }

    public function sendTestEmail() : string //send message email for Registration
    {
        $details = [
            'title' => 'Mail from Laravel',
            'body' => 'This is a test mail using Mailtrap'
        ];
        Mail::to('receiver@example.com')->send(new TestMail($details));

        return 'Mail Sent!';
    }

    public function deleteProfile($id) : object //delete user
    {
        $authUser = Auth::user();
        if ($authUser) {
            if ($authUser->id != $id && $authUser->role === 'admin') {
                $user = User::find($id);
                if ($user) {
                    $this->userService->deleteUserAndAvatar($user);
                }

                return redirect()->route('profile.my');
            }
            if ($authUser->id == $id) {
                Auth::logout();
                $this->userService->deleteUserAndAvatar($authUser);

                return redirect()->route('loginPage');
            }
        }

        abort(404);
    }

    public function show($id) : object //show user
    {
        $user = new User();
        $user = $user->where('id', '=', $id)->first();
        if ($user) {
            return view('auth.profile', compact('user'));
        }

        return back();
    }

    public function products(User $user) : object //show user products
    {
        $data['products'] = $user->products;
        $data['types'] = $user->productsWithTypes->pluck('type')->unique('id');

        return view('index', compact('data'));
    }
}
