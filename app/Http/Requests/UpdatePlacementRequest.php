<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlacementRequest extends FormRequest
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
            'placement_code' => 'required',
			'date' => 'required|date',
			'room_id' => 'required|exists:App\Models\Room,id',
			'staff_id' => 'required|exists:App\Models\User,id',
			'description' => 'required',
			'type' => 'required',
			'created_by' => 'required|exists:App\Models\User,id',
			'company_id' => 'required|exists:App\Models\Company,id',
        ];
    }
}
