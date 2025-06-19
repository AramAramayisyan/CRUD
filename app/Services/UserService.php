<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function updateProfile($request)
    {
        $user = Auth::user();
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
        }
        return $user->update($data);
    }

    public function updatePassword($request)
    {
        if (Hash::check($request->old_password, Auth::user()->password)) {
            return Auth::user()->update(['password' => $request->password]);
        }
    }
}
