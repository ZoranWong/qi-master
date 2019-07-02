<?php

namespace App\Http\Requests;

use App\Models\Master;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MasterServiceUpdateRequest extends FormRequest
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
            'service_type_ids' => 'required|array',
            'key_areas' => 'required|array',
            'other_areas' => 'required|array',
            'work_day' => 'required|array',
            'work_time' => 'required|array',
            'team_nums' => 'required',
            'truck_nums' => 'required',
            'truck_type' => [
                'required',
                Rule::in(array_keys(Master::TRUCK_TYPES))
            ],
            'truck_tonnage' => 'required'
        ];
    }
}
