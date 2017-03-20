<?php

namespace App\Api\Users;

class UserRepository extends ResourceRepository
{
    public function getModel()
    {
        return User::class;
    }
}