<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserAdminController extends Controller
{
    //
    public function index()
    {

        // $admins = Admin::select('id', 'login', 'role')->paginate(10);
        $admins = Admin::select('id', 'login', 'role')->get();

        return view('admin.administrators.index', compact('admins'));
    }


    public function create()
    {

        return view('admin.administrators.create');
    }
    public function store(Request $request)
    {

        $request->validate([
            'login' => 'required|unique:admins',
            'password' => 'required|min:12',
        ]);

        Admin::create([
            'login' => $request->login,
            'password' => Hash::make($request->password),
        ]);


        alert(__('admin.success.create-admin'));

        $request->session()->regenerate();

        return back();
    }

    public function edit($id)
    {

        $admin = Admin::where('id', $id)->first();

        if (!$admin) {
            alert(__('admin.errors.no-data'), 'danger');
            return back();
        }

        return view('admin.administrators.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'login' => 'required|unique:admins',
            'password' => 'required|min:12',
        ]);

        $res = Admin::query()
            ->where('id', $id)
            ->update([
                'login' => $request->login,
                'password' => Hash::make($request->password),
            ]);

        if ($res) {
            alert(__('admin.success.updated'));
        } else {
            alert(__('admin.errors.delete'), 'danger');
        }

        return redirect()->route('administrators.edit', $id);
    }

    public function destroy($id)
    {



        $admin = Admin::where('id', $id)->first();

        if ($admin && $admin->role != 'superadmin' && Auth::guard('admin')->user()->id != $id) {

            $admin->destroy($id);
            alert(__('admin.success.delete'));
        } else {
            alert(__('admin.errors.delete'), 'danger');
        }

        return redirect()->route('administrators.index');
    }
}