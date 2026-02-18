<?php

namespace App\Repositories\Admin;

use App\Interface\Admin\ServiceCategoryAdminInterface;
use App\Models\ServiceCategory;

class ServiceCategoryAdminRepository implements ServiceCategoryAdminInterface
{
    public function all()
    {
        return ServiceCategory::all();
    }
    public function paginate(int $num)
    {
        return ServiceCategory::paginate($num);
    }
    public function find(int $id)
    {
        return ServiceCategory::find($id);
    }
    public function create(array $data)
    {
        return ServiceCategory::create($data);
    }
    public function update($model, array $data)
    {
        return $model->update($data);
    }
}