<?php

namespace App\Http\Requests;

use Illuminate\Support\Arr;
use Illuminate\Foundation\Http\FormRequest;

class StoreSalesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->has('sales')) {
            return [
                'sales' => 'required|array',
                'sales.*.quantity' => 'required|min:0|integer',
                'sales.*.price' => 'required|min:0|integer',
                'sales.*.sold_at' => 'required|date',
            ];
        }

        return [
            'quantity' => 'required|min:0|integer',
            'price' => 'required|min:0|integer',
            'sold_at' => 'required|date',
        ];
    }

    /**
     * Get the sales from the request body.
     *
     * @return  \Illuminate\Support\Collection
     */
    public function sales()
    {
        return $this->has('sales')
            ? collect($this->validated()['sales'])
            : collect(Arr::wrap($this->validated()));
    }
}
