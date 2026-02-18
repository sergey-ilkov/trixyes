<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Services\Backend\CallStream\CallStreamService;
use App\Services\Frontend\AuthUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthUserController extends Controller
{
    //
    public $userService;

    public function __construct(AuthUserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(Request $request)
    {
        $request->validate([
            'action' => 'required',
        ]);

        return $this->userService->register($request);
    }

    public function login(Request $request)
    {


        return $this->userService->login($request);
    }

    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->back();
    }
}
