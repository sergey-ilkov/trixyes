<?php

namespace App\Services\Admin;

use App\Interface\Admin\ActionAdminInterface;

class ActionAdminService
{
    /**
     * Create a new class instance.
     */
    public $actionInterface;

    public function __construct(ActionAdminInterface $actionInterface)
    {
        //
        $this->actionInterface = $actionInterface;
    }


    public function getActions()
    {

        return $this->actionInterface->all();
    }

    public function getPagination($num)
    {
        return $this->actionInterface->paginate($num);
    }

    public function getAction($id)
    {

        return $this->actionInterface->find($id);
    }

    public function createAction($request)
    {

        $data = $this->getFormData($request);


        return $this->actionInterface->create($data);
    }


    public function updateAction($id, $request)
    {
        $action = $this->actionInterface->find($id);

        if (!$action) {

            return false;
        }

        $data = $this->getFormData($request);

        return $this->actionInterface->update($action, $data);
    }



    public function getFormData($request)
    {

        return [
            'name' => $request->name,
            'slug' => $request->slug,
        ];
    }
}