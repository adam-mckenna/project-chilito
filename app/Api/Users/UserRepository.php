<?php

namespace App\Api\Users;

use App\Api\Base\ResourceRepository;

class UserRepository extends ResourceRepository
{
    public function getModel()
    {
        return User::class;
    }
}