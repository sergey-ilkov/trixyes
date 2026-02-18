<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\ServiceCategory;
use App\Models\User;
use App\Services\Backend\CallStream\CallStreamService;
use App\Services\Frontend\ServiceFrontendService;
use function PHPSTORM_META\type;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{

    public $serviceFrontendService;


    public function __construct(ServiceFrontendService $serviceFrontendService)
    {
        $this->serviceFrontendService = $serviceFrontendService;
    }

    public function index()
    {


        $page = 'services';
        $categories = ServiceCategory::all();
        $posts = Post::where('published', 1)->where('slider', 1)->get();

        return view('frontend.services.index', compact('page', 'categories', 'posts'));
    }

    public function services(Request $request)
    {

        return $this->serviceFrontendService->initActions($request);
    }
}
