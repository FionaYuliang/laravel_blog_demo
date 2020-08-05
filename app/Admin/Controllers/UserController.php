<?php

namespace App\Admin\Controllers;

use App\AdminUser;
use App\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\True_;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    /**
     * 管理员列表页面
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    //run ok
    public  function index()
    {
        $users = DB::table('admin_users')
            ->select('*')
            ->orderBy('created_at','desc')
            ->get();

        return view('admin/user/index',compact('users'));

    }

    /**
     * 管理员创建页面,run ok
     */
    public function create()
    {

        return view('admin/user/create');

    }

    /**
     * 管理员创建行为 run ok
     */
    public function store()
    {
        $this->validate(request(),[
            'name' => 'required|string|max:15|min:2',
            'password' => 'required|string|min:5',
        ]);

        $admin_user = new AdminUser();
        $admin_user->name = request('name');
        $admin_user->password = bcrypt(request('password'));
        $admin_user->save();

        return redirect("admin/user");
    }

}
