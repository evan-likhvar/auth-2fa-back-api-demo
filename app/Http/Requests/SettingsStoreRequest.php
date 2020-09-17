<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsStoreRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:settings,name|string|max:100',
            'value' => 'required|string|max:255',
            'default_value' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'type_id' => 'required|integer|exists:value_types,id'
        ];
    }
}
