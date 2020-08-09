<?php

namespace App\Admin\Controllers;

use App\AdminUser;
use App\Post;
use http\Env\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\True_;

class PostController extends Controller
{

    // 管理文章——显示所有未审核的文章
    public  function index()
    {
        $posts = DB::table('posts')
            ->select('*')
            ->orderBy('created_at','desc')
            ->where('status','=','0')
            ->get();

        return view('admin/posts/index',['posts' =>  $posts]);

    }

    // 审核文章，也就是把文章的状态由 0 改成1 或者 -1
    public function changeStatus(Request $request)
    {

        $this->validate(request(),[
            'status' => 'required|in:-1,1',
        ]);

        $post_id  = request('id');
        $target_post = DB::table('posts')->select('*')
            ->where('id','=','post_id');
        $target_post->status= request('status');
        $target_post->save();

        return [
            'error' => 0,
            'msg' => '',
        ];

    }
}
