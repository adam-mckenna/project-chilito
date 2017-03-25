<?php

namespace App\Api\Base;

use App\Api\Interfaces\Repository;

abstract class ResourceRepository extends BaseRepository implements Repository
{
    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function create($id, $data)
    {
        return $this->build($id, $data);
    }

    /**
     * @param $id
     * @param $data
     * @return null
     */
    public function update($id, $data)
    {
        $model = $this->find($id);
        $model->fill($data)->save();
        return $model;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}