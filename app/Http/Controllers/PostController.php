<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Like;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Sodium\compare;

class PostController extends Controller
{
    public function index()
    {
        return 1;
        //Post模型和PostController都属于model，相关可用php artisan help make:model命令查看
//        $posts = Post::orderBy('created_at','desc')->withCount(['comments','likes'])->paginate(6);
//        return view('posts/index',compact('posts'));


        $posts = DB::table('posts')
            ->select('posts.id as post_id','posts.title','posts.content','posts.created_at',
                'users.id as user_id','users.name')
            ->join('users', 'posts.user_id', '=','users.id')
            ->orderBy('posts.created_at','desc')
            ->get();

        return view('posts/index',['posts'=>$posts]);

    }

    public function detail(Post $post)
    {

        $post->load('comments'); // controller 中做好预加载，不要直接在View层查询

        return view("posts/detail",compact('post'));
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

//        $posts = DB::insert('insert * from posts inner join users on posts.user_id = users.id');
//        $params = array_merge(request(['title','content']),compact('user_id'));
//        $post = Post::create($params);

        return redirect("posts/index");

    }

    //    文章评论
    public function comment(Post $post,Request $request)
    {
        $this->validate(request(),[
            'content' => 'required|string|min:5',
        ]);
        //dd($post);
        //dd($request->all());
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

        return redirect("posts/{$post->id}",compact('post'));
    }

    public function delete(Post $post)
    {

        //用户权限验证
        $this->authorize('delete',$post);
        $post->delete();

        return redirect("posts/index");
    }

    public function like(Post $post)
    {

        $param = [
            'user_id' => \Auth::id(),
            'post_id' => $post->id
        ];
        Like::firstOrCreate($param);
        return back();

    }

    public function unlike(Post $post)
    {
        $post->like(\Auth::id())->delete();
        return back();
    }


}
