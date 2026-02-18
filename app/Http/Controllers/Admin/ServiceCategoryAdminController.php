<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceCategoryAminFormRequest;
use App\Models\Language;
use App\Services\Admin\ServiceCategoryAdminService;
use Illuminate\Http\Request;

class ServiceCategoryAdminController extends Controller
{
    //
    public $serviceCategoryService;

    public function __construct(ServiceCategoryAdminService $serviceCategoryService)
    {
        $this->serviceCategoryService = $serviceCategoryService;
    }


    public function index()
    {
        $categories = $this->serviceCategoryService->getPagination(10);



        return view('admin.service-сategories.index', compact('categories'));
    }

    public function create()
    {
        $languages = Language::all();

        return view('admin.service-сategories.create', compact('languages'));
    }

    public function store(ServiceCategoryAminFormRequest $request)
    {

        $category = $this->serviceCategoryService->createCategory($request);

        if ($category) {
            alert(__('admin.success.create'));
        } else {
            alert(__('admin.errors.error'), 'danger');
        }

        return back();
    }

    public function edit($id)
    {
        $category = $this->serviceCategoryService->getCategory($id);

        if (!$category) {
            alert(__('admin.errors.no-data'), 'danger');
            return back();
        }
        $languages = Language::all();
        return view('admin.service-сategories.edit', compact('category', 'languages'));
    }

    public function update(ServiceCategoryAminFormRequest $request, $id)
    {

        $res = $this->serviceCategoryService->updatecategory($id, $request);

        if ($res) {
            alert(__('admin.success.updated'));
        } else {
            alert(__('admin.errors.error'), 'danger');
        }

        return back();
    }
}
