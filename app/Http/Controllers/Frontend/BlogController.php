<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    //
    public function index()
    {



        $page = 'blog';

        $posts = Post::where('published',  true)->orderBy('created_at', 'desc')->paginate(4);

        // $services = Service::where('published', 1)->orderBy('rating', 'desc')->take(10)->get();
        // $services = Service::where('published', 1)->orderBy('rating', 'desc')->limit(10)->get();

        // $services = Service::where('published', 1)->limit(10)->get();
        $category = ServiceCategory::where('slug', 'f-rating')->with(['services' => function ($query) {
            $query->where('published', 1)->limit(10);
        }])->find(1);

        $services = null;
        if ($category) {
            $services = $category->services;
        }


        return view('frontend.blog.index', compact('page', 'posts', 'services'));
    }

    public function show($slug)
    {


        $post = Post::where('slug->' . app()->getLocale(), $slug)->first();

        // $post = Post::where('slug', $slug)->first();
        // $post = Post::whereJsonContains('slug', $slug)->get();

        // dd($post);


        if ($post) {

            $page = 'article';


            return view('frontend.article.index', compact('page', 'post'));
        }

        return abort(404);
    }
}