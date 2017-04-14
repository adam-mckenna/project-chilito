<?php

namespace App\Api\Users\Requests;

use Dingo\Api\Http\FormRequest;

class CreateAvatarRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->isBasic();
    }

    public function rules()
    {
        return [
            'image' => 'required|image',
        ];
    }
}