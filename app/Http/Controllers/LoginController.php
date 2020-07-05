<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public  function index()
    {

        return view('user.login');

    }


    public  function authenticate(Request $request)
    {
      $this->validate(request(),[
          'email' => 'required|email',
          'password' => 'required|min:5|max:15',
          'is_remember' => 'integer'
      ]);

       $user = request(['email','password']);
       $is_remember = boolval(request('is_remember'));
       $response = \Auth::attempt($user, $is_remember);

        if ($response) {

            // 通过认证..
            return redirect('posts/index');
        }
        return redirect()->back()->withErrors("邮箱密码不匹配");
    }


    public  function logout()
    {
         Auth::logout();

        return redirect('login');

    }
}
