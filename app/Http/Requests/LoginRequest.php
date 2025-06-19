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
            'emails' => ['required', 'emails', 'regex:/^[\w\.\-]+@([\w\-]+\.)+(com|ru)$/i', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/'],
        ];
    }
}
