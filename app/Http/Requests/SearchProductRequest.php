<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class SearchProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['string', 'max:255'],
            'type_id' => ['integer', 'exists:product_types,id'],
        ];
    }

    public function validationData()
    {
        return $this->query();
    }
}
