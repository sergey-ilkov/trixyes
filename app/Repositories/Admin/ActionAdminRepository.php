<?php

namespace App\Repositories\Admin;

use App\Interface\Admin\ActionAdminInterface;
use App\Models\Action;

class ActionAdminRepository implements ActionAdminInterface
{

    public function all()
    {
        return Action::all();
    }
    public function paginate(int $num)
    {
        return Action::paginate($num);
    }
    public function find(int $id)
    {
        return Action::find($id);
    }
    public function create(array $data)
    {
        return Action::create($data);
    }
    public function update($model, array $data)
    {
        return $model->update($data);
    }
}