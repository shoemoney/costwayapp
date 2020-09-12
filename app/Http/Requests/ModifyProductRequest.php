<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModifyProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'provider' => 'required|string|in:ebay',
            'identifier' => 'required|string',
            'name' => 'required|string',
            'description' => 'string',
            'images.0.url' => 'required|string',
            'images.*.url' => 'string',
            'price' => 'required|integer',
            'currency' => 'required|string|in:GBP',
        ];
    }
}
