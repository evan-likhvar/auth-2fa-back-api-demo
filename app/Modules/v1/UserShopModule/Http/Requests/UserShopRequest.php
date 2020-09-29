<?php

namespace App\Modules\v1\UserShopModule\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserShopRequest extends FormRequest
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
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'shop_type_id' => ['required', 'integer', 'exists:user_shop_types,id'],
            'name' => ['nullable', 'string', 'max:255'],
        ];
    }
}
