<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

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
     * 当前用户是否关注了uid
     * @param $uid
     */
    public function hasStar($uid)
    {
        return $this->getStars()->where('following_id',$uid)->count();
    }

    /**
     * 个人中心：获取用户相关信息
     * @param $uid
     * @return array
     */
    public function getInfo($uid){
        $user = DB::table("users")
            ->select("*")
            ->where("id","=" ,$uid)
            ->first();
        $username = $user->name;
        $model_follow = new Follow();
        $model_post = new Post();

        $fan_count = $model_follow->getFanNum($uid);
        $star_count = $model_follow->getStarNum($uid);
        $post_count = $model_post->getPostNum($uid);

        return [
            "user_id" => $uid,
            "username" => $username,
            "fan_count" => $fan_count,
            'star_count' => $star_count,
            'post_count' =>$post_count
        ];
    }
}
