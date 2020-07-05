<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{

    protected $fillable = ['title','content'];
    // 关联模型：一对一反向关联
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }


    public function like($user_id)
    {
        return $this->hasOne(\App\Like::class)->where('user_id',$user_id);
    }

    public function likeCount($user_id){
        return $this->hasMany(\App\Like::class);
    }
}

