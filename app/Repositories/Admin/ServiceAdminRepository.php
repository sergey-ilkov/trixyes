<?php

namespace App\Repositories\Admin;

use App\Interface\Admin\ServiceAdminInterface;
use App\Models\Service;
use App\Models\ServiceCategory;

class ServiceAdminRepository implements ServiceAdminInterface
{

    public function all()
    {
        return Service::with('serviceCategories')->get();
    }


    public function paginate(int $num)
    {
        return Service::with('serviceCategories')->paginate($num);
    }


    public function find(int $id)
    {
        return Service::with('serviceCategories')->find($id);
    }

    public function create(array $data)
    {


        $service = Service::create($data);

        if (!$service) {
            return false;
        }

        $ratings = [];

        $categories = ServiceCategory::all();

        foreach ($categories as $category) {
            $ratings[$category->id] = ['rating' => $data[$category->slug]];
        }


        $service->serviceCategories()->attach($ratings);

        return true;
    }


    public function update($model, array $data)
    {


        $model->update($data);

        $ratings = [];

        $categories = ServiceCategory::all();

        foreach ($categories as $category) {
            $ratings[$category->id] = ['rating' => $data[$category->slug]];
        }
        $model->serviceCategories()->sync($ratings);

        return true;
    }


    public function delete($model)
    {
        return $model->delete();
    }
}