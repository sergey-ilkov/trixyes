<?php

namespace App\Services\Admin;

use App\Interface\Admin\ServiceCategoryAdminInterface;

class ServiceCategoryAdminService
{
    /**
     * Create a new class instance.
     */
    public $serviceCategoryInterface;

    public function __construct(ServiceCategoryAdminInterface $serviceCategoryInterface)
    {
        //
        $this->serviceCategoryInterface = $serviceCategoryInterface;
    }

    public function getCategories()
    {
        return $this->serviceCategoryInterface->all();
    }

    public function getPagination($num)
    {
        return $this->serviceCategoryInterface->paginate($num);
    }

    public function getCategory($id)
    {
        return $this->serviceCategoryInterface->find($id);
    }

    public function createCategory($request)
    {

        $data = $this->getFormData($request);


        return $this->serviceCategoryInterface->create($data);
    }


    public function updateCategory($id, $request)
    {
        $category = $this->serviceCategoryInterface->find($id);

        if (!$category) {

            return false;
        }

        $data = $this->getFormData($request);

        return $this->serviceCategoryInterface->update($category, $data);
    }


    public function getFormData($request)
    {

        return [
            'name' => $request->name,
            'title' => $request->title,
            'description' => $request->description,
            'slug' => $request->slug,
        ];
    }
}