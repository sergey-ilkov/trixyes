<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    //
    public function index(Request $request)
    {


        $reviews = Review::all();

        $posts = Post::where('published', 1)->where('slider', 1)->get();

        $page = 'home';

        return view('frontend.home.index', compact('page', 'reviews', 'posts'));
    }
}
