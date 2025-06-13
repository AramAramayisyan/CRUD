<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class ProductIdRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => [ 'exists:products,id']
        ];
    }
}
