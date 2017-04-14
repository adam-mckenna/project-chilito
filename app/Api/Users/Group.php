<?php

namespace App\Api\Users;

use App\Api\Base\BaseModel;

class Group extends BaseModel
{
    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_group');
    }
}
