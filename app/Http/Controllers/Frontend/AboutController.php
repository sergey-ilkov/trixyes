<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    //
    public function index()
    {
        $reviews = Review::all();

        $page = 'about';

        return view('frontend.about.index', compact('page', 'reviews'));
    }
}