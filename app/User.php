<?php

namespace App;
use App\BaseModel;
use App\Follow as MFollow;
use App\Topic as MTopic;
use App\Post as MPost;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class User extends BaseModel
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
    public function getInfo($uid){
        $user = DB::table("users")
            ->select('id','name')
            ->where("id","=" ,$uid)
            ->first();
        $uid = $user->id;

        $username = $user->name;

        $fan_count = MFollow::Instance()->getFanNum($uid);
        $star_count = MFollow::Instance()->getStarNum($uid);
        $post_count = MPost::Instance()->getPostCount($uid);


        return [
            "user_id" => $uid,
            "username" => $username,
            "fan_count" => $fan_count,
            'star_count' => $star_count,
            'post_count' =>$post_count
        ];
    }
}
