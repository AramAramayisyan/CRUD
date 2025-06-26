<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function updateProfile($request) :bool // update profile
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

    public function updatePassword($request) :bool // update password
    {
        if (Hash::check($request->old_password, Auth::user()->password)) {
            Auth::user()->update(['password' => $request->password]);
            return true;
        }
        return false;
    }

    public function deleteUserAndAvatar(User $user) : void // delete user and avatar
    {
        $avatar = $user->avatar;
        if ($user->forceDelete() && $avatar && $avatar !== 'avatars/default/default.jpg') {
            Storage::disk('public')->delete($avatar);
        }
    }
}
