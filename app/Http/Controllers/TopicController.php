<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Like;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Topic as MTopic;

class TopicController extends Controller
{
    public  function show(Request $request){

        $uri =$request->getRequestUri();
        $array = explode('/' , $uri);
        $topic_id = $array[2];

        $result = MTopic::Instance()->getPostList($topic_id);
        $topic_id = $result['topic_id'];
        $topic_name = $result['topic_name'];
        $post_id_list = $result['post_id_list'];

        //根据某个主题的全部文章id列表,查找出所有的文章信息
        $posts = DB::table('posts')
            ->select('*')
            ->where('status','=','1')
            ->whereIn('id',$post_id_list)
            ->get();

        //找出来之后,用count()就行啦,无需使用sql的count
        $posts_count = count($posts);

        //查找登录用户的文章里,不在当前主题的post_id_list里的文章列表,并传递给
        $uid = Auth::id();
        $myposts = DB::table('posts')->select('id','title')
            ->where('user_id','=',$uid)
            ->whereNotIn('id',$post_id_list)
            ->get();
        $myposts_count = count($myposts);


        //原生sql查询,要照顾到侧边栏的专题列表,这里暂时再查一遍
        $topics = DB::table('topics')->select('*')->orderBy('id')->get();
//        $topic_info = compact('topic_id','topic_name','posts_count');

        return view('topic/detail', [
            'topics'=>$topics,
            'posts'=>$posts,
            'myposts'=>$myposts,
            'topic_id'=>$topic_id,
            'topic_name'=>$topic_name,
            'posts_count'=>$posts_count,
            'myposts_count'=>$myposts_count,
        ]);
    }

    public function submit(Request $request){
        $this->validate(request(),[
            'post_ids' => 'required|array',
        ]);

        $topic_id = $request->query("topic_id");
        $post_ids = $request->post("post_ids");

        foreach($post_ids as $post_id){
            DB::table('post_topics')->insertOrIgnore(
                [
                    'post_id' => $post_id,
                    'topic_id'=> $topic_id,
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                ]
            );
        }
        return back();

    }
}
