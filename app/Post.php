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



    //获得当前用户的文章数量
    public function  getPostCount($param)
    {
        $post_count = DB::table('posts')
            ->where('user_id','=',$param)->count();

        return $post_count;
    }

    //获得当前用户的文章分页




    //获得数据库所有的文章数量，并计算出页数
    public function getMaxPage()
    {
        $total_entry = DB::table('posts')->count();
        $page_size = 4;
        $max_page = ceil($total_entry/$page_size);

        return $max_page;
    }

    //获得当前页面对应的文章列表
    public function getCpagePost($current_page){

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

    //与分页器直接进行交互，返回当前页面的文章列表，默认$current_page=1
    public function showPagePost($current_page)
    {

        $posts = $this->getCpagePost($current_page);
        $max_page = $this->getMaxPage();

        return [
            'posts'=>$posts,
            'max_page'=>$max_page
        ];
    }


    //根据某个参数，查找出参数相关的文章总数和文章页数
    public  function get_all_posts($param)
    {
        $total_entry = $this->getPostCount($param);

        $page_size = 4;
        $max_page = ceil($total_entry/$page_size);

        return ['total_entry'=>$total_entry, 'max_page'=> $max_page];

    }

    //从专题文章id列表（二级数据库）中，获取当前页应该展示的内容
    public function getTopicPost($current_page,$post_id_list)
    {

        $page_size = 4;
        $offset_value = $page_size * ($current_page - 1);

        $posts = DB::table('posts')
            ->where('status','=','1')
            ->whereIn('id',$post_id_list)
            ->join('users', 'posts.user_id', '=','users.id')
            ->select('posts.*','users.*')
            ->offset($offset_value)
            ->limit($page_size)
            ->get();

        $posts = $posts->toArray();

        return  $posts;
    }




    //查找登录用户的文章里,不在当前主题的post_id_list里的文章列表
    public function get_myposts($uid,$post_id_list)
    {

        $myposts = DB::table('posts')->select('id','title')
            ->where('user_id','=',$uid)
            ->whereNotIn('id',$post_id_list)
            ->get();

        return $myposts;
    }

}

