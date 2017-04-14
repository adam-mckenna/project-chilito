<?php

namespace App\Api\Users\Requests;

use Dingo\Api\Http\FormRequest;

class ReadUserRequest extends FormRequest
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
        return [];
    }
}