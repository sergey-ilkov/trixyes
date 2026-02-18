<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\Langs;
use App\Http\Controllers\Controller;
use App\Mail\SendCode;
use App\Models\CallStreamTask;
use App\Models\CallStreamToken;
use App\Models\Post;
use App\Models\User;
use App\Services\Backend\CallStream\CallStreamService;
use App\Services\Backend\CallStream\CallStreamTaskService;
use App\Services\Backend\CallStream\CallStreamTokenService;
use App\Services\Frontend\AuthUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class TestController extends Controller
{
    //

    public function show($token)
    {
        return $token;
    }

    public function index(AuthUserService $authUser, CallStreamService $callStream, CallStreamTokenService $callStreamToken, CallStreamTaskService $callStreamTask)
    {
        // $data = [
        //     'code' => 777,
        //     'url' => route('home'),
        // ];

        // $email = 'test@sergeyilkov.com';

        // Mail::to($email)->send(new SendCode($data));

        echo 'Test controller <br>';
    }
}