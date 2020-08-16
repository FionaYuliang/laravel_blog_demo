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
        //Post模型和PostController都属于model，相关可用php artisan help make:model命令查看
//        $posts = Post::orderBy('created_at','desc')->withCount(['comments','likes'])->paginate(6);
//        return view('posts/index',compact('posts'));

        $posts = DB::table('posts')
            ->select('posts.id as post_id','posts.title','posts.content','posts.created_at',
                'users.id as user_id','users.name')
            ->where('status','=','1')
            ->join('users', 'posts.user_id', '=','users.id')
            ->orderBy('posts.created_at','desc')
            ->take(6)
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
        $post  =$raw_result[0];
//        dd($post);

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

    public function store()
    {
         $this->validate(request(),[
           'title' => 'required|string|max:100|min:10',
           'content' => 'required|string|min:10',
        ]);

        $post = new Post();
        $post->title = request('title');
        $post->content = request('content');
        $post->user_id = Auth::id();
        $post->save();


        return redirect("posts/index");

    }

    //    文章评论
    public function comment(Post $post,Request $request)
    {
        $this->validate(request(),[
            'content' => 'required|string|min:5',
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->post_id = $post->id;
        $comment->content= request('content');
        $comment->save();

        return view('posts/detail',compact('post'));
    }

    public function edit(Post $post)
    {

        return view("posts/edit",compact('post'));
    }

    public function update(Post $post)
    {
        $this->validate(request(),[
            'title' => 'required|string|max:100|min:10',
            'content' => 'required|string|min:10',
        ]);

        $this->authorize('update',$post);

        $post->title = request('title') ;
        $post->content= request('content');
        $post->save();

        return redirect("posts/{$post->id}");
    }

    public function delete(Post $post)
    {

        //用户权限验证
        $this->authorize('delete',$post);
        $post->delete();

        return redirect("posts/index");
    }
}
