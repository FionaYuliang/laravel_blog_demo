<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable=['content'];

    public function post()
    {
        return $this->belongsTo('App\Post')->orderBy('created_at','desc');
    }

    public function user(){

        return $this->belongsTo('App\User');
    }

    //文章详情页的评论列表


    //文章详情页增加平陵
}
