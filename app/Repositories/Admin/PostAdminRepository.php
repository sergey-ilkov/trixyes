<?php

namespace App\Repositories\Admin;

use App\Interface\Admin\PostAdminInterface;
use App\Models\Post;

class PostAdminRepository implements PostAdminInterface
{

    public function all()
    {
        return Post::all();
    }
    public function paginate(int $num)
    {
        return Post::paginate($num);
    }
    public function find(int $id)
    {
        return Post::find($id);
    }
    public function create(array $data)
    {
        return Post::create($data);
    }
    public function update($post, array $data)
    {
        return $post->update($data);
    }
    public function delete($post)
    {

        return $post->delete();
    }
}