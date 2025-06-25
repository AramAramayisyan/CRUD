<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\LoginService;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    private $adminService;

    public function __construct()
    {

    }

    public function index()
    {
//        $user = Auth::user();
//        if ($user->role == 'manager') {
//
//        }

    }
}
