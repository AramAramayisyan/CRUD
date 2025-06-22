<?php

namespace App\Services;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistrationService
{
    public function register(RegistrationRequest $request)
    {
        $newUser = new User();
        $newUser->fill([
            'name' => $request['name'],
            'emails' => $request['emails'],
            'password' => Hash::make($request['password']),
        ]);
        if ($newUser->save()) {
            event(new Registered($newUser));
            Auth::login($newUser);
            return true;
        }
        return null;
    }
}
