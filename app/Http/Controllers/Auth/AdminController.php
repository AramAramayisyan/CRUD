<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Services\LoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    private $adminService;

    public function __construct()
    {

    }

    public function updateUserRole(Request $request, User $user) : object //update user role
    {
        $user->update(['role' => $request['role']]);
        return back();
    }
}
