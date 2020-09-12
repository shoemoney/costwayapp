<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModifySaleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'quantity' => 'required|min:0|integer',
            'price' => 'required|min:0|integer',
            'sold_at' => 'required|date',
        ];
    }
}
