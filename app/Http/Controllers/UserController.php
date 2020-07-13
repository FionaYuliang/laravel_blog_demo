<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function profile(User $user)
    {
        //当前用户信息，包含他的文章，关注的用户，粉丝
//        $user = User::withCount(['posts','followings','followers'])->find($user->id);

        $user = DB::table('User')->where('id',$user->id);
        $posts_num = DB::table('posts')
            ->where('user_id',$user->id)
            ->count();
        $stars_num = DB::table('follow')
            ->where('following_id',$user->id) //当前用户去关注别人，他是follower_id
            ->count();

        $fans_num = DB::table('follow')
            ->where('follower_id',$user->id)
            ->count();

        //当前用户的文章列表，取最新10条
//        $posts = $user->posts()->orderBy('created_at','desc')->take(10)->get();

        $posts_list = DB::table('posts')
            ->where('user_id',$user->id)
            ->orderBy('created_at','desc')
            ->tale(10)
            ->get();

        //当前用户关注 用户的文章数，关注数，被关注数
//        $followers = $user->follower();
//        $ufollowers = User::whereIn('id',$followers->pluck('follower_id'))
//            ->withCount(['posts','followings','follower'])->get();

        //当前用户 关注的用户(当前用户是follower_id,)
        $first_query = DB::table('user')
            ->join('follows','user.id','=','follows.follower_id')
            ->select('follows.follower_id');

        $stars_name = $first_query->select('user.name')->get();

        //关注的用户关注了多少用户
        $stars_star_count = $first_query->join('follows','','=','follows.following_id')->count();

        //关注的用户被多少人关注
        $stars_fans_count = $first_query->

        //当前用户 关注的用户的文章数
        $ers_posts_num = DB::table('posts')
            ->union($first_query)
            ->join('follows','posts.user_id','=','follows.follower_id')
            ->count();


        //当前用户的粉丝的文章数，关注数，被关注数
//        $followings = $user->following();
//        $ufollowings = User::whereIn('id',$followings->pluck('following_id'))
//            ->withCount(['posts','followings','follower'])->get();


        return view('user/profile',
            compact('user','posts','ufollowers','ufollowings'));
    }

    //当前用户关注其他用户
    public  function follow(User $user)
    {

        $me = \Auth::user();
        $me->doFollower($user->id);

        return [
            'error'=>0,
            'msg'=> '',
        ];
    }
    //当前用户取消关注其他用户
    public function unfollow(User $user)
    {
        $me = \Auth::user();
        $me->doUnFollowing($user->id);

        return [
            'error'=>0,
            'msg'=> '',
        ];

    }

    //个人设置页面
    public  function setting()
    {
        return view('user.setting');
    }

    //个人设置行为
    public  function settingStore()
    {
        return view('user.me');
    }



}
