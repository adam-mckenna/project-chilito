<?php

namespace App\Api\Repositories;

abstract class ResourceRepository extends BaseRepository
{
    public function create($id, $data)
    {
        return $this->build($id, $data);
    }

    public function update($id, $data)
    {
        $model = $this->find($id);
        $model->fill($data)->save();
        return $model;
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}