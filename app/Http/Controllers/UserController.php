<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * User Model里getInfo函数的返回值传递给控制层
     * @param User $user
     * @return
     */
    public function profile(User $user)
    {

        $model_user = new User();
        // 当前登录用户的信息
        $userInfo = $model_user->getInfo($user->id);
        //当前用户最新10篇文章
        $posts = DB::table('posts')
            ->select('*')
            ->where('posts.user_id','=',$user->id)
            ->orderBy('created_at','desc')
            ->get();

//         当前用户关注用户的列表
        $stars_list = DB::table('follows')
            ->select('*')
            ->where('follower_id','=',$user->id)
            ->get();

        $stars_result_list  = [];
        foreach($stars_list as $stars){
            $star_info= $model_user->getInfo($stars->id);
            array_push($stars_result_list, $star_info);
        }

        // 当前用户粉丝用户列表
        $fans_list = DB::table('follows')
            ->select('*')
            ->where('following_id','=',$user->id)
            ->get();

        $fans_result_list  = [];
        foreach($fans_list as $fans){
            $fan_info = $model_user->getInfo($fans->id);
            array_push($fans_result_list, $fan_info);
        }

        return view('user/profile',
            compact('userInfo','posts','stars_result_list','fans_result_list'));
    }

    /**
     *
     * @param User $user
     * @return array
     */
    public  function follow(User $user)
    {

        $me = \Auth::user();
        $me->doFollower($user->id);

        return [
            'error'=>0,
            'msg'=> '',
        ];
    }
    /**
     * 当前用户取消关注其他用户
     * @param User $user
     * @return array
     */
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
