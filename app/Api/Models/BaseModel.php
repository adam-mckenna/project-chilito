<?php

namespace App\Api\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected static $includes = [];

    public static function find($id)
    {
        if (is_null($id)) {
            return null;
        }

        $model = static::where('id', $id);
        if (count(static::$includes)) {
            $model = $model->with(static::$includes);
        }
        $model = $model->first();

        return $model;
    }
}