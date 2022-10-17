<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAssetRequest extends FormRequest
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
            'name' => 'required',
			'unit_id' => 'required|exists:App\Models\Unit,id',
			'specification' => 'required',
			'stock' => 'required|numeric',
			'description' => 'required',
			'category_id' => 'required|exists:App\Models\Category,id',
			'company_id' => 'required|exists:App\Models\Company,id',
        ];
    }
}
