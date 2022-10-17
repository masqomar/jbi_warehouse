<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComingProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => 'required|date',
            'product_id' => 'required|exists:App\Models\Product,id',
            'price' => 'required|numeric',
            'qty' => 'required|numeric',
            'supplier_id' => 'nullable|exists:App\Models\Supplier,id',
        ];
    }
}
