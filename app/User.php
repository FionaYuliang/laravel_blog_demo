<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable=['name','email','password'];


    //用户文章列表
    public function posts()
    {
        return $this->hasMany(\App\Post::class,'user_id','id');

    }

    //用户被多少人关注了
    public  function followers()
    {
        return $this->hasMany(\App\Follow::class,'follower_id','id');

    }
    //用户关注了多少人

    public function followings()
    {
        return $this->hasMany(\App\Follow::class,'following_id','id');
    }

    //登录用户关注别人
   public function doFollowing($uid)
   {
       $following = new \App\Follow();
       $following->following_id = $uid;
       return $this->followings()->save($following);
   }
   //登录用户取消关注别人
    public function doUnFollowing($uid)
    {
        $following = new \App\Follow();
        $following->following_id = $uid;
        return $this->followings()->delete($following);
    }

    //当前用户是否被uid关注
    public function hasFollower($uid)
    {
          $this->followers()->where('follower_id',$uid)->count();
    }
      //当前用户是否关注了uid
    public function hasFollowing($uid)
    {
        $this->followers()->where('following_id',$uid)->count();
    }
}
