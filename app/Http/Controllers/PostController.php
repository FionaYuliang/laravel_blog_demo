<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Like;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    //首页文章展示
    public function index()
    {

        $posts = DB::table('posts')
            ->select('posts.id as post_id','posts.title','posts.content','posts.created_at',
                'users.id as user_id','users.name')
            ->where('status','=','1')
            ->join('users', 'posts.user_id', '=','users.id')
            ->orderBy('posts.created_at','desc')
            ->take(10)
            ->get();

        $posts = $posts->toArray();

//        $topics = DB::table('topics')->select('*')->orderBy('id')->get();

         return view('posts/index',['posts'=>$posts]);


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

        return view("posts/detail",[
            'post' => $post,
            'comments' => $comments,
            'comments_count'=>$comments_count,
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


        DB::table('users')->insertGetId([
            'post_id' => $post_id,
            'user_id' => $user_id,
            'content' =>$content,
            ]);

        return [
            'error' => 0,
            'msg' => '评论成功',
        ];


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
}
