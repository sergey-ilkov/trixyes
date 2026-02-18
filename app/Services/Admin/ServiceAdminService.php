<?php

namespace App\Services\Admin;

use App\Interface\Admin\ServiceAdminInterface;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Storage;

class ServiceAdminService
{
    /**
     * Create a new class instance.
     */
    public $serviceInterface;

    public function __construct(ServiceAdminInterface $serviceInterface)
    {
        //
        $this->serviceInterface = $serviceInterface;
    }


    public function getServices()
    {

        return $this->serviceInterface->all();
    }

    public function getPagination($num)
    {
        return $this->serviceInterface->paginate($num);
    }

    public function getService($id)
    {

        return $this->serviceInterface->find($id);
    }

    public function createService($request)
    {

        $data = $this->getFormDataSaveImages($request);


        return $this->serviceInterface->create($data);
    }


    public function updateService($id, $request)
    {
        $service = $this->serviceInterface->find($id);


        if (!$service) {

            return false;
        }

        $data = $this->getFormDataSaveImages($request, $service);

        return $this->serviceInterface->update($service, $data);
    }

    public function deleteService($id)
    {
        $service = $this->serviceInterface->find($id);

        if (!$service) {
            return false;
        }

        $this->deleteImage($service->icon);

        return $this->serviceInterface->delete($service);
    }


    public function getFormDataSaveImages($request, $service = null)
    {

        $pathImage = '';

        $image = $request->file('icon');


        if (!$image && $service) {
            $pathImage = $service->icon;
        }

        if ($image) {

            $name = time();
            $ext = $image->getClientOriginalExtension();
            $imageName = $name . '.' . $ext;
            $pathImage = $image->storeAs('/images/services', $imageName);


            if ($service) {
                $this->deleteImage($service->icon);
            }
        }

        $data = [
            'name' => $request->name,
            'icon' => $pathImage,
            'alt_image' => $request->alt_image,
            'interset' => $request->interset,
            'term' => $request->term,
            'amount' => $request->amount,
            // 'promo_code' => $request->promo_code,
            // 'promo_discount' => $request->promo_discount,
            'vote_rating' => $request->vote_rating,
            'vote_count' => $request->vote_count,
            'url' =>  $request->url,
            'license' => $request->license,
            'comp_name' => $request->comp_name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' =>  $request->phone,
            'published' => $request->has('published') ? true : false,

            'f-rating' => $request['f-rating'],
            'f-approve' => $request['f-approve'],
            'f-cost' => $request['f-cost'],

        ];

        if ($request->promo_code) {
            $data['promo_code'] =  $request->promo_code;
        }
        if ($request->promo_discount) {
            $data['promo_discount'] =  $request->promo_discount;
        }

        return $data;
    }

    public function deleteImage($imagePath)
    {
        Storage::disk('public')->delete($imagePath);
    }
}