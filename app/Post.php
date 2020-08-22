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


    public function getPageSum(){
        $total_entry = DB::table('posts')->select('*')->count();
        $page_size = 4;
        $max_page = ceil($total_entry/$page_size);


        return $max_page;

    }
    public function getPaginatePost($current_page){

        $page_size = 4;
        $offset_value = $page_size * ($current_page - 1);

        $posts = DB::table('posts')
            ->select('posts.id as post_id','posts.title','posts.content','posts.created_at',
                'users.id as user_id','users.name')
            ->where('status','=','1')
            ->join('users', 'posts.user_id', '=','users.id')
            ->orderBy('posts.created_at','desc')
            ->offset($offset_value)
            ->limit($page_size)
            ->get();

        $posts = $posts->toArray();

        return $posts;
    }

}

