<?php

namespace App\Services;

use App\Http\Requests\RegistrationRequest;
use App\Mail\TestMail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegistrationService
{
    public function register(RegistrationRequest $request) : bool //register
    {
        $newUser = new User();
        $newUser->fill([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role' => 'user', // Default role for new users
        ]);
        if ($newUser->save()) {
            event(new Registered($newUser));
            Auth::login($newUser);
            Mail::to($request->email)->queue(new TestMail($request->name));
            return true;
        }
        return false;
    }
}
