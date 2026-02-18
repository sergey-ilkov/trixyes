<?php

namespace App\Interface\Admin;

interface PostAdminInterface
{
    public function all();
    public function paginate(int $num);
    public function find(int $id);
    public function create(array $data);
    public function update($post, array $data);
    public function delete($post);
}
