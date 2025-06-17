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
            'type_id' => ['integer', 'required', 'exists:product_types,id'],
            'name' => ['string', 'required', 'max:255'],
            'description' => ['string', 'required', 'min:10']
        ];
    }
}
