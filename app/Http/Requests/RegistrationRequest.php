<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'name' => ['required', 'string', 'max:25'],
            'email' => ['required', 'email', 'regex:/^[\w\.\-]+@([\w\-]+\.)+com$/i', 'unique:users,email', 'max:255'],
            'password' => ['required', 'string', 'confirmed', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/'],
        ];
    }
}
