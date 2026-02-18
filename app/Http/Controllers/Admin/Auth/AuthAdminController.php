<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Services\BlockingUsers\BlockingUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthAdminController extends Controller
{
    //
    public function login(Request $request, BlockingUsers $services)
    {

        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.home');
        }
        // echo  'user: ' . Auth::user() . '<br>';
        // echo  'admin: ' . Auth::guard('admin')->user() . '<br>';


        if ($services->isBlocked($request)) {
            return view('admin.auth.login')->with('blocking', 'the user is blocked');
        }

        return view('admin.auth.login');
    }

    public function authenticate(Request $request, BlockingUsers $services)
    {

        if ($services->isBlocked($request)) {
            return view('admin.auth.login')->with('blocking', 'the user is blocked');
        }


        $validation = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],

        ]);


        $data = clearTags($validation);


        if (Auth::guard('admin')->attempt($data)) {


            $request->session()->regenerate();

            return redirect()->route('admin.home');
        }


        $services->createOrUpdateBlockedUser($request);

        return back()->withErrors([
            'error' => 'wrong login or password',
        ]);
    }

    public function logout(Request $request)
    {

        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect()->route('admin.login');
    }
}