<?php

namespace App\Api\Users\Requests;

use Dingo\Api\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'active' => 'boolean',
        ];
    }
}