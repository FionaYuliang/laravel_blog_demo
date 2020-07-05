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


}

