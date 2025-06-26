<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class editPassRequest extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'old_password' => ['required', 'string', 'min:8', 'max:255', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/'],
            'password' => ['required', 'string', 'confirmed', 'different:old_password', 'min:8','max:255', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/'],
        ];
    }
}
