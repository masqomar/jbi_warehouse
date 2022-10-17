<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMutationToRequest extends FormRequest
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
            'mutation_id' => 'required|exists:App\Models\Mutation,id',
			'placement_id' => 'required|exists:App\Models\Placement,id',
			'description' => 'nullable',
        ];
    }
}
