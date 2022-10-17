<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAssetMaintenanceRequest extends FormRequest
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
            'asset_item_id' => 'required|exists:App\Models\AssetItem,id',
            'finish_date' => 'required|date',
            'finish_note' => 'required',
            'status' => 'required|in:Proses,Selesai',
        ];
    }
}
