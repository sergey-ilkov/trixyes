<?php

namespace App\Interface\Admin;

interface ServiceCategoryAdminInterface
{
    //
    public function all();
    public function paginate(int $num);
    public function find(int $id);
    public function create(array $data);
    public function update($model, array $data);
}
