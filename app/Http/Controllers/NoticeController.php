<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Like;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NoticeControllerextends Controller
{

    //通知中心首页
    public function index()
    {

        $posts = DB::table('posts')
            ->select('posts.id as post_id','posts.title','posts.content','posts.created_at',
                'users.id as user_id','users.name')
            ->where('status','=','1')
            ->join('users', 'posts.user_id', '=','users.id')
            ->orderBy('posts.created_at','desc')
            ->take(6)
            ->get();

        $posts = $posts->toArray();

//        $topics = DB::table('topics')->select('*')->orderBy('id')->get();

         return view('posts/index',['posts'=>$posts]);


    }

}
