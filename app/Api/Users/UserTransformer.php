<?php

namespace App\Api\Users;

use League\Fractal\TransformerAbstract;

/**
 * Class UserTransformer
 *
 * @package App\Api\Transformers
 */
class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'active' => $user->active
        ];
    }
}