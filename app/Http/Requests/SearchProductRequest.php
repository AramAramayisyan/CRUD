<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class SearchProductRequest extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'name' => ['string', 'max:255'],
            'type_id' => ['integer', 'exists:product_types,id'],
        ];
    }

    public function validationData() : array
    {
        return $this->query();
    }
}
