<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssetItemRequest extends FormRequest
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
            'code' => 'required',
			'full_code' => 'required',
			'asset_id' => 'required|exists:App\Models\Asset,id',
			'purchasing_no' => 'nullable',
			'purchasing_date' => 'required|date',
			'status' => 'required',
			'category_id' => 'required|exists:App\Models\Category,id',
			'company_id' => 'required|exists:App\Models\Company,id',
			'created_by' => 'required|exists:App\Models\User,id',
			'updated_by' => 'required|exists:App\Models\User,id',
        ];
    }
}
