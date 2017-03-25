<?php

namespace App\Api\Interfaces;


interface Repository
{
    public function create($id, $data);
    public function update($id, $data);
    public function delete($id);
}