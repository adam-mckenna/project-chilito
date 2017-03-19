<?php

namespace App\Api\Repositories;

use App\Api\Models\User;

class UserRepository extends ResourceRepository
{
    public function getModel()
    {
        return User::class;
    }
}