<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ActionAdminFormRequest;
use App\Models\Language;
use App\Services\Admin\ActionAdminService;
use Illuminate\Http\Request;

class ActionAdminController extends Controller
{
    public $actionService;

    public function __construct(ActionAdminService $actionService)
    {
        $this->actionService = $actionService;
    }

    public function index()
    {
        $actions = $this->actionService->getPagination(10);

        return view('admin.actions.index', compact('actions'));
    }

    public function create()
    {
        $languages = Language::all();

        return view('admin.actions.create', compact('languages'));
    }

    public function store(ActionAdminFormRequest $request)
    {


        $action = $this->actionService->createAction($request);

        if ($action) {
            alert(__('admin.success.create'));
        } else {
            alert(__('admin.errors.error'), 'danger');
        }

        return back();
    }

    public function edit($id)
    {
        $action = $this->actionService->getAction($id);

        if (!$action) {
            alert(__('admin.errors.no-data'), 'danger');
            return back();
        }

        $languages = Language::all();

        return view('admin.actions.edit', compact('action', 'languages'));
    }

    public function update(ActionAdminFormRequest $request, $id)
    {



        $res = $this->actionService->updateAction($id, $request);

        if ($res) {
            alert(__('admin.success.updated'));
        } else {
            alert(__('admin.errors.error'), 'danger');
        }

        return back();
    }
}
