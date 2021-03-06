<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Like;
use App\Post as MPost;
use App\User;
use App\Topic as MTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    //网站首页
     public  function index(Request $request)
     {
         $current_page = $request->query("page", 1);

         $posts = MPost::Instance()->getIndexPaginate($current_page);
         $posts_count = MPost::Instance()->getDBPostCount();
         $max_page = MPost::Instance()->getMaxPage($posts_count);

         $topics = MTopic::Instance()->getSidebar();

        return view('posts/index',[
            'posts' => $posts,
            'topics' => $topics,
            'current_page' => $current_page,
            'max_page' => $max_page
        ]);

     }

    //文章详情页,需要展示文章信息/评论总数/评论列表

    public function detail(Request $request)
    {

        $post_id = $request->query('post_id');

        $raw_result = DB::table('posts')->select('*')
            ->where('id','=',$post_id)
            ->get()
            ->toArray();


        $post  = $raw_result[0];


        $comments  = DB::table('comments')->select('*')
            ->where('post_id','=',$post_id)
            ->get();

        $comments_count= count($comments);

        $like_count = DB::table('likes')
            ->select('*')
            ->where('post_id','=',$post_id)
            ->count();

        $topics = MTopic::Instance()->getSidebar();

        return view("posts/detail",[
            'post' => $post,
            'comments' => $comments,
            'comments_count'=>$comments_count,
            'like_count'=>$like_count,
            'topics'=>$topics
            ]);
    }

    public function create()
    {

        return view("posts/create");
    }

    public function store(Request $request)
    {
         $this->validate(request(),[
           'title' => 'required|string|max:100|min:10',
           'content' => 'required|string|min:10',
        ]);


        $post_title = request('title');
        $post_content = request('content');
        $post_user_id = Auth::id();

        DB::table('posts')->insertGetId([
            'title' => $post_title,
            'content' => $post_content,
            'user_id'=>$post_user_id,
        ]);


        return redirect("posts/index");

    }

    public function edit(Post $post)
    {

        return view("posts/edit",compact('post'));
    }

    public function update(Request $request)
    {
        $this->validate(request(),[
            'title' => 'required|string|max:100|min:10',
            'content' => 'required|string|min:10',
        ]);

        $post_id = $request->post('post_id');
        $post_title = $request->post('title') ;
        $post_content= $request->post('content');


        DB::table('posts')
        ->where('id','=',$post_id)
        ->update(['title'=>$post_title,'content'=>$post_content]);


        return redirect("posts/{$post_id}?post_id=${post_id}");
    }

    public function delete(Post $post)
    {

        //用户权限验证
        $this->authorize('delete',$post);
        $post->delete();

        return redirect("posts/index");
    }

    //    文章评论
    public function comment(Request $request)
    {

        $user_id = \Auth::id();
        $post_id = $request->post('post_id');
        $content = $request->post("content");

        if(strlen($content) <= 5){
            return [
                'error' => 1,
                'msg' => '评论内容不能小于5个字符',
            ];
        }

        DB::table('comments')->insertGetId([
            'post_id' => $post_id,
            'user_id' => $user_id,
            'content' =>$content,
        ]);

        return $this->asyncShowError("". "评论成功");



    }

     //文章点赞
    public  function like(Request $request){

        $post_id = $request->post('post_id');
        $user_id = \Auth::id();

        $is_exist = DB::table('likes')->select('*')
            ->where('post_id','=',$post_id)
            ->where('user_id','=',$user_id)
            ->exists();

        if($is_exist == 0){
            DB::table('likes')->insertOrIgnore(
                ['post_id' => $post_id, 'user_id' => $user_id]
            );
            return [
                'error'=> 0,
                'msg'=>'谢谢你的点赞!',
            ];
        }else{

            return [
                'error'=> 1,
                'msg'=>'你已经点过赞啦,可以试试关注',
            ];
        }
    }

    //文章取消点赞
    public function unlike(Request $request){

        $post_id = $request->post('post_id');
        $user_id = \Auth::id();

         DB::table('likes')->select('*')
            ->where('post_id','=',$post_id)
            ->where('user_id','=',$user_id)
            ->delete();

        return [
            'error'=>0,
            'msg'=>'取消点赞',
        ];

    }
}
