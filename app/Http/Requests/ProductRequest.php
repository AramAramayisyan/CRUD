<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['string', 'required', 'max:255'],
            'description' => ['string', 'required', 'min:10'],
            'type' => ['required', 'in:computer,laptop,phone,table']
        ];
    }
}
