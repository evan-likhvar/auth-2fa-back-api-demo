<?php

namespace App\Modules\v1\Settings\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'value' => 'required|string|max:255',
            'default_value' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'type_id' => 'required|integer|exists:value_types,id'
        ];
    }
}
