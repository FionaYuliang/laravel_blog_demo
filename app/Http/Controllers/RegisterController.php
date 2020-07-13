<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public  function index()
    {

        return view('user.register');
    }

    public  function register()
    {
        $this->validate(request(),[
            'name' => 'required|min:3|unique:users,name',
            'email'=> 'required|unique:users,email|email',
            'password'=> 'required|min:6|max:13|confirmed',
        ]);

        $user = new User();
        $user->name = request('name');
        $user->email = request('email');
        $user->password = bcrypt(request('password'));
        $user->save();

//        $user = User::create(compact('name','email','password'));
        return redirect('login');
    }
}
