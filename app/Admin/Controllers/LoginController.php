<?php

namespace App\Admin\Controllers;

use phpDocumentor\Reflection\Types\True_;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public  function index()
    {
        return view('admin.login.index');

    }

    public  function login()
    {
        $this->validate(request(),[
            'name' => 'required|min:2',
            'password' => 'required|min:5|max:15',
        ]);

        $user = request(['name','password']);
        $response = Auth::guard('admin')->attempt($user, true);

        if ($response) {
            // 通过认证..
            return redirect('admin/home');
        }
        return redirect()->back()->withErrors("用户名密码不匹配");


    }

    public  function logout()
    {


        Auth::guard('admin')->logout();

        return redirect('/admin/login');


    }



}
