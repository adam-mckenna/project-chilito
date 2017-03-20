<?php

namespace App\Api\Base;

use Closure;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class BaseRepository
{
    abstract public function getModel();

    final public function newQuery()
    {
        $model = $this->getModel();
        return (new $model)->newQuery();
    }

    public function find($id, $fail = true)
    {
        if (is_null($id)) {
            if ($fail) {
                throw new NotFoundHttpException();
            } else {
                return null;
            }
        }

        $model = $this->newQuery()->find($id);

        if (is_null($model) && $fail) {
            throw new NotFoundHttpException();
        }

        return $model;
    }

    protected function build($id, $data = null, Closure $callback = null)
    {
        $model = $this->instantiate($id, $data);

        if (!is_null($callback)) {
            $callback($model);
        }

        if ($model->isDirty()) {
            $model->save();
        }

        return $model;
    }

    public function instantiate($id, $data = null)
    {
        $classname = $this->getModel();
        if (is_null($data)) {
            $data = [];
        }
        $model = new $classname($data);
        $model->id = $id;
        return $model;
    }
}