<?php

namespace App\Services\Frontend;

use App\Models\Action;
use App\Models\History;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class ServiceFrontendService
{

    protected $limit = 8;
    protected $user = null;


    public function initActions($request)
    {

        $this->user = auth('web')->user();


        $request->validate([
            'action' => 'required',
        ]);



        if ($request->action == 'get-services') {

            if ($this->user) {
                $user_id = $this->user->id;
                $categories = ServiceCategory::with(['services' => function ($query) use ($user_id) {
                    $query->where('published', 1)->with(['userHistories' => function ($query) use ($user_id) {
                        $query->where('user_id', $user_id);
                    }]);
                }])->get();
            } else {
                $categories = ServiceCategory::with(['services' => function ($query) {
                    $query->where('published', 1);
                }])->get();
            }

            return $this->getServices($categories);
        }



        if ($request->action == 'get-services-category') {

            $request->validate([
                'slug' => 'required',
                'offset' => 'required',
            ]);


            if ($this->user) {
                $user_id = $this->user->id;

                $category = ServiceCategory::where('slug', $request->slug)->with(['services' => function ($query) use ($user_id) {
                    $query->where('published', 1)->with(['userHistories' => function ($query) use ($user_id) {
                        $query->where('user_id', $user_id);
                    }]);
                }])->first();
            } else {
                $category = ServiceCategory::where('slug', $request->slug)->with(['services' => function ($query) {
                    $query->where('published', 1);
                }])->first();
            }


            if ($category) {
                return $this->getServicesCategory($category->services, $request->offset);
            }

            $error = [
                "status" => "error",
                'errors' => [
                    'slug' => "Category not found",
                ]
            ];

            return response()->json($error);
        }


        // ? user action
        if ($this->user) {
            $actionUser = $request->action;

            $request->validate([
                'service_id' => 'required',
            ]);

            if ($actionUser == 'hidden-service' || $actionUser == 'active-service') {

                return $this->updateOrCreateActionHistory($actionUser, $request->service_id);
            }

            if ($actionUser == 'get-credit') {

                return $this->createActionHistory($actionUser, $request->service_id);
            }
        }




        $error = [
            "status" => "error",
            'errors' => [
                'action' => "Invalid action field value",
            ]
        ];

        return response()->json($error);
    }



    public function updateOrCreateActionHistory($actionUser, $service_id)
    {


        $action = $this->validateAction($actionUser, $service_id);

        $history = History::updateOrCreate([
            'service_id' => $service_id,
            'user_id' => $this->user->id,
            'action_id' => $action->id
        ]);


        if ($history) {

            $history->updated_at = Carbon::now();
            $history->save();

            $resData = [
                'status' => 'ok',
            ];
            return response()->json($resData);
        }

        $error = [
            "status" => "error",
            'errors' => [
                'create' => "Error update or create",
            ]
        ];

        return response()->json($error);
    }

    public function createActionHistory($actionUser, $service_id)
    {

        $action = $this->validateAction($actionUser, $service_id);

        $history = History::create([
            'service_id' => $service_id,
            'user_id' => $this->user->id,
            'action_id' => $action->id
        ]);


        if ($history) {

            $resData = [
                'status' => 'ok',
            ];
            return response()->json($resData);
        }

        $error = [
            "status" => "error",
            'errors' => [
                'create' => "Error update or create",
            ]
        ];

        return response()->json($error);
    }


    public function validateAction($actionUser, $service_id)
    {
        $errors = [];

        $action = Action::where('slug', $actionUser)->first();

        if (!$action) {
            $errors['action'] = 'Invalid action field value';
        }


        $service = Service::where('id', $service_id)->first();

        if (!$service) {
            $errors['service_id'] = 'Invalid service_id field value';
        }

        if (!empty($errors)) {
            $error = [
                "status" => "error",
                'errors' => $errors,
            ];

            return response()->json($error);
        }

        return $action;
    }

    public function getServices($categories)
    {

        $resData = [
            'status' => 'ok',
            'auth' => $this->user ?  true :  false,
            'data' => [],
            'translations' => Lang::get('services'),
        ];


        foreach ($categories as $category) {


            $services = $this->getServicesCategoryPagination($category->services);


            $resData['data'][$category->slug] = [];
            $resData['data'][$category->slug]['data'] = [];

            $resData['data'][$category->slug]['current_page'] = $services['current_page'];
            $resData['data'][$category->slug]['last_page'] = $services['last_page'];
            $resData['data'][$category->slug]['offset'] = $services['offset'];
            $resData['data'][$category->slug]['to'] = $services['to'];
            $resData['data'][$category->slug]['total'] = $services['total'];


            foreach ($services['data'] as $service) {

                $tempData = $this->getFormData($service);

                array_push($resData['data'][$category->slug]['data'], $tempData);
            }
        }

        if (empty($resData['data'])) {
            $error = [
                "status" => "error",
                'errors' => [
                    'get-services' => __('messages.services_not_db'),
                ]
            ];

            return response()->json($error);
        }


        return response()->json($resData);
    }



    public function getServicesCategory($services, $offset)
    {

        $resData = [
            'status' => 'ok',
            'data' => [],
        ];


        $services = $this->getServicesCategoryPagination($services, $offset);

        $resData['current_page'] = $services['current_page'];
        $resData['last_page'] = $services['last_page'];
        $resData['offset'] = $services['offset'];
        $resData['to'] = $services['to'];
        $resData['total'] = $services['total'];


        foreach ($services['data'] as $service) {

            $tempData = $this->getFormData($service);

            array_push($resData['data'], $tempData);
        }


        return response()->json($resData);
    }





    public function getServicesCategoryPagination($services, $offset = 0)
    {


        $servicesLimit =  $services->skip($offset * $this->limit)->take($this->limit);
        $total = $services->count();
        $offsetTo = $this->limit + ($offset * $this->limit);
        $to =  $offsetTo < $total ? $offsetTo : (($offset * $this->limit) < $total ? $total : null);
        $current_page = $offset + 1;
        $last_page = ceil($total / $this->limit);

        $resData = [
            'data' => $servicesLimit,
            'current_page' => $current_page,
            'last_page' => $last_page,
            'offset' => $offset,
            'to' => $to,
            'total' => $total,
        ];

        return $resData;
    }


    public function getFormData($service)
    {

        $temp = [];

        $temp['id'] = $service->id;
        $temp['name'] = $service->name;
        $temp['icon'] = asset('storage/' . $service->icon);
        $temp['alt_image'] = $service->alt_image;
        $temp['interest'] = $service->interset;
        $temp['term'] = $service->term;
        $temp['amount'] = $service->amount;

        // $temp['promo_code'] = $this->user ?  $service->promo_code : 'XXX-XXX-XXX';

        if ($this->user) {
            $temp['promo_code'] = $service->promo_code;
        } else {
            if ($service->promo_code) {
                $temp['promo_code'] = 'XXX-XXX-XXX';
            } else {
                $temp['promo_code'] = $service->promo_code;
            }
        }

        $temp['promo_discount'] = $service->promo_discount;
        $temp['vote_rating'] = $service->vote_rating;
        $temp['vote_count'] = $service->vote_count;

        $temp['rating'] = $service->pivot->rating;

        $temp['url'] = $service->url;
        $temp['license'] = $service->license;
        $temp['comp_name'] = $service->comp_name;
        $temp['email'] = $service->email;
        $temp['address'] = $service->address;
        $temp['phone'] = $service->phone;


        if ($this->user) {
            $status = 'active-service';


            $temp['histories'] = [];

            $histories = $service->userHistories->sortBy('updated_at');

            foreach ($histories as $history) {
                $tempHistory = [];

                $tempHistory['name'] = $history->action->name;
                $tempHistory['updated_at'] = Carbon::create($history->updated_at)->format('d.m.Y');


                $slug = $history->action->slug;
                if ($slug == 'hidden-service' || $slug == 'active-service') {
                    $status = $slug;
                }

                array_push($temp['histories'], $tempHistory);
            }


            $temp['isHidden'] = $status == 'hidden-service' ? true : false;
        }


        return $temp;
    }
}