<?php

namespace App\Services\Admin;

use App\Interface\Admin\ReviewAdminInterface;



class ReviewAdminService
{
    /**
     * Create a new class instance.
     */

    public $reviewInterface;

    public function __construct(ReviewAdminInterface $reviewInterface)
    {
        //
        $this->reviewInterface = $reviewInterface;
    }


    public function getReviews()
    {

        return $this->reviewInterface->all();
    }

    public function getPagination($num)
    {
        return $this->reviewInterface->paginate($num);
    }

    public function getReview($id)
    {

        return $this->reviewInterface->find($id);
    }

    public function createReview($request)
    {

        $data = $this->getFormData($request);


        return $this->reviewInterface->create($data);
    }


    public function updateReview($id, $request)
    {
        $review = $this->reviewInterface->find($id);

        if (!$review) {

            return false;
        }

        $data = $this->getFormData($request);

        return $this->reviewInterface->update($review, $data);
    }

    public function deleteReview($id)
    {
        $review = $this->reviewInterface->find($id);

        if (!$review) {
            return false;
        }


        return $this->reviewInterface->delete($review);
    }


    public function getFormData($request)
    {

        return [
            'name' => $request->name,
            'surname' => $request->surname,
            'rating' => $request->rating,
            'text' => $request->text,
        ];
    }
}