<?php

namespace App;

use App\Post as MPost;
use App\Topic as MTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\BaseModel;


class Post extends BaseModel
{
    private $page_size = 4;

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


    //获取网站首页文章总数量
    public function getDBPostCount()
    {
        $total_entry = DB::table('posts')->count();

        return $total_entry;
    }

    //获得当前用户的文章总数量
    public function  getUserPostCount($param)
    {
        $total_entry = DB::table('posts')
            ->where('user_id','=',$param)->count();

        return $total_entry;
    }

    //获取某个专题下的文章总数量
    public function getTPostCount($topic_id){

        $total_entry  = DB::table('post_topics')
            ->select('post_id')
            ->where('topic_id','=',$topic_id)
            ->count();

        return $total_entry;
    }

    //根据文章数量获取文章的页数
    public function getMaxPage($total_entry)
    {
        $max_page = ceil($total_entry/$this->page_size);

        return $max_page;
    }


    //根据current_page计算offset
    public function get_offset($current_page){

        $offset= $this->page_size * ($current_page - 1);

        return $offset;
    }

    //获得网站首页的文章分页表
    public function getIndexPaginate($current_page){

        $offset = $this->get_offset($current_page);

        $posts = DB::table('posts')
            ->select('posts.id as post_id','posts.title','posts.content','posts.created_at',
                'users.id as user_id','users.name')
            ->where('status','=','1')
            ->join('users', 'posts.user_id', '=','users.id')
            ->orderBy('posts.created_at','desc')
            ->offset($offset)
            ->limit($this->page_size)
            ->get();

        $posts = $posts->toArray();
        return $posts;
    }


    //获得个人中心的用户文章分页列表
    public function getUserPaginate($uid,$current_page){

        $offset = $this->get_offset($current_page);

       $posts = DB::table('posts')->select('*')
           ->where('user_id','=',$uid)
           ->orderBy('created_at','desc')
           ->offset($offset)
           ->limit($this->page_size)
           ->get();

        $posts = $posts->toArray();
        return $posts;
    }



    //根据专题id，获取该专题的文章id列表 post_id_list

    public function getPidList($topic_id){

        $raw_pid_list= DB::table('post_topics')
            ->select('post_id')
            ->where('topic_id','=',$topic_id)
            ->get();

        $pid_list =  $raw_pid_list->toArray();

        $posts_id_list = [];

        foreach($pid_list as $raw_id){
            array_push($posts_id_list, $raw_id->post_id);
        }

        return  $posts_id_list;
    }


    //从专题文章id列表中，获得专题详情页的文章分页列表
    public function getTPostPaginate($current_page,$post_id_list)
    {

        $offset = $this->get_offset($current_page);

        $posts = DB::table('posts')
            ->where('status','=','1')
            ->whereIn('id',$post_id_list)
            ->join('users', 'posts.user_id', '=','users.id')
            ->select('posts.*','users.*')
            ->offset($offset)
            ->limit($this->page_size)
            ->get();

        $posts = $posts->toArray();

        return  $posts;
    }


    //获得登录用户的文章里,不在当前主题的post_id_list里的文章id和title
    public function getMyPosts($uid,$post_id_list)
    {

        $myposts = DB::table('posts')->select('id','title')
            ->where('user_id','=',$uid)
            ->whereNotIn('id',$post_id_list)
            ->get();

        return $myposts;
    }



    //文章详情页，根据post_id展示文章信息



}

