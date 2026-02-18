<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blocking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeAdminController extends Controller
{
    //
    public function index()
    {



        $info = [];
        // ? blockings
        $blockings = Blocking::where('blocking', true)->count();
        $info['blockings'] = $blockings ?? 0;

        return view('admin.home.index', compact('info'));
    }
}
