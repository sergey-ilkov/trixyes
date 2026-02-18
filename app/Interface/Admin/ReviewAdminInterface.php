<?php

namespace App\Interface\Admin;

interface ReviewAdminInterface
{
    public function all();
    public function paginate(int $num);
    public function find(int $id);
    public function create(array $data);
    public function update($model, array $data);
    public function delete($model);
}