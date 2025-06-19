<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'emails' => ['required', 'emails', 'regex:/^[\w\.\-]+@([\w\-]+\.)+(com|ru)$/i', 'max:255'],
        ];
    }
}
