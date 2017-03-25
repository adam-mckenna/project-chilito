<?php

namespace App\Api\Users\Requests;

use Dingo\Api\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'ebay_user' => 'required',
            'active' => 'required | boolean',
        ];
    }
}