<?php

namespace App\Repositories\Admin;

use App\Interface\Admin\ReviewAdminInterface;
use App\Models\Review;

class ReviewAdminRepository implements ReviewAdminInterface
{

    public function all()
    {
        return Review::all();
    }
    public function paginate(int $num)
    {
        return Review::paginate($num);
    }
    public function find(int $id)
    {
        return Review::find($id);
    }
    public function create(array $data)
    {
        return Review::create($data);
    }
    public function update($model, array $data)
    {
        return $model->update($data);
    }
    public function delete($model)
    {
        return $model->delete();
    }
}
