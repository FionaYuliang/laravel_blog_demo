<?php

namespace App\Http\Controllers;

use App\Topic as MTopic;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
            ->get()->toArray();

        if($stars_list != []){
            $stars_result_list  = [];
            foreach($stars_list as $stars){
                $star_info= $model_user->getInfo($stars->following_id);
                array_push($stars_result_list, $star_info);
            }
        }else{
            $stars_result_list = 0;
        }


        // 当前用户粉丝用户列表
        $fans_list = DB::table('follows')
            ->select('*')
            ->where('following_id','=',$user->id)
            ->get()->toArray();

          if($fans_list != []){
              $fans_result_list  = [];
              foreach($fans_list as $fans){
                  $fan_info = $model_user->getInfo($fans->follower_id);
                  array_push($fans_result_list, $fan_info);
              }
          }else{
             $fans_result_list = 0;
          }


        $topics = MTopic::Instance()->getSidebar();

        return view('user/profile',
            compact('userInfo','posts','stars_result_list','fans_result_list','topics'));
    }

    //个人设置页面

    public  function setting()
    {
        $my_id = \Auth::id();

        $avatar_url =  DB::table('user_infos')->where('user_id','=',$my_id)
            ->value('avatar_url');

        return view('user/setting',['avatar_url'=>$avatar_url]);
    }

    //个人设置行为:修改用户名
    public  function changeName(Request $request)
    {
        $new_username = $request->post('new_username');
        $user_id = \Auth::id();

        DB::table('users')->where('id','=',$user_id)
            ->update(['name'=>$new_username]);

        DB::table('user_infos')->where('id','=',$user_id)
            ->update(['username'=>$new_username]);

        return [
          'error'=>0,
          'msg'=>'用户名修改成功',
        ];
    }

    //个人设置行为:修改头像
    public  function changeAvatar(Request $request)
    {

        $avatar_url = $request->post('avatar_url');
        $user_id = \Auth::id();

        DB::table('user_infos')->where('id','=',$user_id)
            ->update(['avatar_url'=>$avatar_url]);

        return [
            'error'=>0,
            'msg'=>'头像修改成功',
        ];
    }
    /**
     *登录用户关注当前用户
     * @param User $user
     * @return array
     */
    public  function follow(Request $request)
    {

        $following_id = $request->post('following_id');
        $follwer_id = \Auth::id();

       $is_exist =  DB::table('follows')->select('*')
            ->where('following_id','=',$following_id)
            ->where('follower_id','=',$follwer_id)
            ->exists();

       if($is_exist == 0){
           DB::table('follows')->insertGetId(
               ['following_id'=>$following_id,'follower_id'=>$follwer_id]);
           return [
               'error' => 0,
               'msg' => '关注成功',
           ];
       }else{

           return [
               'error' => 1,
               'msg' => '不能重复关注',
           ];
       }


    }

    /**
     * 登录用户取消当前其他用户
     * @param Request $request
     * @return array
     */
    public function unfollow(Request $request)
    {

        $following_id = $request->post('following_id');

        $follower_id = \Auth::id();

        $entry = DB::table('follows')
            ->select('*')
            ->where('following_id','=',$following_id)
            ->where('follower_id','=',$follower_id)
            ->delete();


        return [
            'error' => 0,
            'msg' => '取消关注了',
        ];
    }

}
