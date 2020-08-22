<?php

namespace App;

use App\Post as MPost;
use App\Topic as MTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\BaseModel;


class Post extends BaseModel
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

//以下是文章分页逻辑
    public function getPageSum()
    {
        $total_entry = DB::table('posts')->count();
        $page_size = 4;
        $max_page = ceil($total_entry/$page_size);

        return $max_page;
    }

    public function getPagePost($current_page){

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

    //使用分页器展示文章列表页，默认$page_num=1
    //用到文章列表页的地方有：网站首页、专题详情页、个人中心文章列表页
    public function showPagePost($current_page)
    {

        $posts = $this->getPagePost($current_page);
        $max_page = $this->getPageSum();

        return [
            'posts'=>$posts,
            'max_page'=>$max_page
        ];
    }


    public function get_pdetail_By_pid($post_id_list)
    {

        //根据某个主题的全部文章id列表,查找出所有的文章信息

        $posts = DB::table('posts')
            ->join('users','posts.user_id','=','users.id')
            ->select('posts.*','users.id','users.name')
            ->where('posts.status','=','1')
            ->whereIn('posts.id',$post_id_list)
            ->get();

        return  $posts;
    }

    //查找登录用户的文章里,不在当前主题的post_id_list里的文章列表
    public function get_mypost_notin($uid,$post_id_list)
    {

        $myposts = DB::table('posts')->select('id','title')
            ->where('user_id','=',$uid)
            ->whereNotIn('id',$post_id_list)
            ->get();

        return $myposts;
    }

}

