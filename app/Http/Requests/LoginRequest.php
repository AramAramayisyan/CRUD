<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => ['required', 'email', 'regex:/^[\w\.\-]+@([\w\-]+\.)+com$/i', 'exists:users,email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/'],
        ];
    }
}
