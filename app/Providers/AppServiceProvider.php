<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {
            $authUser = auth()->user();
            if (!$authUser) {
                return null;
            }
            if ($authUser->isAdmin()) {
                $users = User::where('id', '!=', $authUser->id)
                    ->where('role', '!=', 'admin')
                    ->get();
            } elseif ($authUser->isManager()) {
                $users = User::where('id', '!=', $authUser->id)
                    ->where('role', 'user')
                    ->get();
            } else {
                $users = collect();
            }
            $view->with('users', $users);
        });
    }

}
