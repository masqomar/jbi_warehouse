<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreElectricityRequest extends FormRequest
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
            'meter_number' => 'required|max:255',
            'building_id' => 'required|exists:App\Models\Building,id',
            'company_id' => 'required|exists:App\Models\Company,id',
            'amount' => 'required|numeric',
            'note' => 'nullable',
            'extra_note' => 'nullable',
        ];
    }
}
