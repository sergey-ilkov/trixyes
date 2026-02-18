<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ReviewAdminFormRequest;
use App\Services\Admin\ReviewAdminService;
use Illuminate\Http\Request;

class ReviewAdminController extends Controller
{
    public $reviewService;

    public function __construct(ReviewAdminService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function index()
    {
        $reviews = $this->reviewService->getPagination(10);

        return view('admin.reviews.index', compact('reviews'));
    }

    public function create()
    {
        return view('admin.reviews.create');
    }

    public function store(ReviewAdminFormRequest $request)
    {

        $review = $this->reviewService->createReview($request);

        if ($review) {
            alert(__('admin.success.create'));
        } else {
            alert(__('admin.errors.error'), 'danger');
        }

        return back();
    }

    public function edit($id)
    {
        $review = $this->reviewService->getReview($id);

        if (!$review) {
            alert(__('admin.errors.no-data'), 'danger');
            return back();
        }

        return view('admin.reviews.edit', compact('review'));
    }

    public function update(ReviewAdminFormRequest $request, $id)
    {
        $res = $this->reviewService->updateReview($id, $request);

        if ($res) {
            alert(__('admin.success.updated'));
        } else {
            alert(__('admin.errors.error'), 'danger');
        }

        return back();
    }

    public function destroy($id)
    {
        $res = $this->reviewService->deleteReview($id);

        if ($res) {
            alert(__('admin.success.delete'));
        } else {
            alert(__('admin.errors.delete'), 'danger');
        }

        return back();
    }
}
