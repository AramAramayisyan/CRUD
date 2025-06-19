<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:25'],
            'emails' => ['required', 'emails', 'regex:/^[\w\.\-]+@([\w\-]+\.)+com$/i', 'unique:users,emails', 'max:255'],
            'password' => ['required', 'string', 'confirmed', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/'],
        ];
    }
}
