<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceAdminFormRequest;
use App\Models\Language;
use App\Models\ServiceCategory;
use App\Services\Admin\ServiceAdminService;
use Illuminate\Http\Request;

class ServiceAdminController extends Controller
{
    public $serviceAdminService;

    public function __construct(ServiceAdminService $serviceAdminService)
    {
        $this->serviceAdminService = $serviceAdminService;
    }

    public function index()
    {


        $services = $this->serviceAdminService->getPagination(10);


        $categories = ServiceCategory::all();

        return view('admin.services.index', compact('services', 'categories'));
    }

    public function create()
    {

        $categories = ServiceCategory::all();

        $languages = Language::all();

        return view('admin.services.create', compact('categories', 'languages'));
    }

    public function store(ServiceAdminFormRequest $request)
    {



        $request->validate([
            'icon' => 'required',
        ]);

        $service = $this->serviceAdminService->createService($request);


        if ($service) {
            alert(__('admin.success.create'));
        } else {
            alert(__('admin.errors.error'), 'danger');
        }

        return back();
    }

    public function edit($id)
    {

        $categories = ServiceCategory::all();

        $service = $this->serviceAdminService->getService($id);


        if (!$service) {
            alert(__('admin.errors.no-data'), 'danger');
            return back();
        }
        $languages = Language::all();

        return view('admin.services.edit', compact('service', 'categories', 'languages'));
    }

    public function update(ServiceAdminFormRequest $request, $id)
    {



        $res = $this->serviceAdminService->updateService($id, $request);

        if ($res) {
            alert(__('admin.success.updated'));
        } else {
            alert(__('admin.errors.error'), 'danger');
        }

        return back();
    }

    public function destroy($id)
    {

        if (auth('admin')->user()->role !== 'superadmin') {

            alert(__("You don't have access"), 'danger');
            return back();
        }

        $res = $this->serviceAdminService->deleteService($id);

        if ($res) {
            alert(__('admin.success.delete'));
        } else {
            alert(__('admin.errors.delete'), 'danger');
        }

        return back();
    }
}