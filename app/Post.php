<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


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

    /**
     * @param $uid
     * @return int
     */
    public function  getPostNum($uid)
    {
        $post_count = DB::table('posts')->select('*')
            ->where('user_id','=',$uid)->count();

        return $post_count;
    }

}

