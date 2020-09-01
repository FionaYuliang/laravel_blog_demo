<?php

namespace App;
use App\BaseModel;
use App\Follow as MFollow;
use App\Topic as MTopic;
use App\Post as MPost;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    protected $fillable=['name','email','password'];

    /**
     * 用户文章列表
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(\App\Post::class,'user_id','id');

    }

    /**
     * 根据uid获取用户信息
     * @param $uid
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function getUserInfo($uid){
        $user = DB::table('users')->select('*')
            ->where('id', $uid)
            ->first();
        return $user;
    }


    /**
     * 用户被多少人关注了
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public  function getFans()
    {
        return $this->hasMany(\App\Follow::class,'follower_id','id');

    }
    /**
     * 用户关注了多少人
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getStars()
    {
        return $this->hasMany(\App\Follow::class,'following_id','id');
    }


    /**
     * 当前用户是否被uid关注
     * @param $uid
     */
    public function hasFan($uid)
    {
        return $this->getFans()->where('follower_id',$uid)->count();
    }

    /**
     * 登录用户是否关注了当前uid
     * @param $target_uid
     */
    public function hasStar($uid)
    {
        $user_id = \Auth::id();

        $is_follow = DB::table('follows')->select('*')
            ->where('following_id', $uid)
            ->where('follower_id',$user_id)
            ->exists();

        return $is_follow;
    }

    /**
     * 登录用户是否给当前post_id点赞了
     * @param $post_id
     */
    public function haslike($post_id)
    {
        $user_id = \Auth::id();

        $is_like = DB::table('likes')
            ->select('*')
            ->where('post_id', '=',$post_id)
            ->where('user_id','=',$user_id)
            ->exists();
        return $is_like;
    }


    /**
     * 个人中心：获取用户相关信息
     * @param $uid
     * @return array
     */
    public function itemCounters($uid){

        $user = DB::table("users")
            ->select('id','name')
            ->where("id","=" ,$uid)
            ->first();

        $username = $user->name;
        $user_id = $user->id;

        $fan_count = MFollow::Instance()->getFanNum($uid);
        $star_count = MFollow::Instance()->getStarNum($uid);
        $post_count = MPost::Instance()->getUserPostCount($uid);


        return [
            'username'=>$username,
            'user_id' => $user_id,
            "fan_count" => $fan_count,
            'star_count' => $star_count,
            'post_count' =>$post_count
        ];
    }

    //获取目标用户--关注人列表
    public function getStarUser($uid){

        $stars_list = DB::table('follows')
            ->select('*')
            ->where('follower_id','=',$uid)
            ->get()->toArray();

        $lens = count($stars_list);
        if($lens != 0){
            $stars_result_list  = [];
            $model_user = new User();
            foreach($stars_list as $star){
                $star_info= $model_user->itemCounters($star->following_id);
                array_push($stars_result_list, $star_info);
            }
        }else{
            $stars_result_list = 0;
        }

        return $stars_result_list;
    }

    //获取目标用户--粉丝列表
    public function getFansUser($uid){

        $fans_list = DB::table('follows')
            ->select('*')
            ->where('following_id','=',$uid)
            ->get()->toArray();

        $lens = count($fans_list);
        if($lens != 0){
            $fans_result_list  = [];
            $model_user = new User();
            foreach($fans_list as $fan){
                $fan_info= $model_user->itemCounters($fan->follower_id);
                array_push($fans_result_list, $fan_info);
            }
        }else{
            $fans_result_list = 0;
        }

        return $fans_result_list;
    }

}
