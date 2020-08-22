<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Like;
use App\Post as MPost;
use App\User as MUser;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Topic as MTopic;

class TopicController extends Controller
{

    //专题详情页
    public  function show(Request $request){

        $topic_id =$request->query('topic_id');

        $result = MTopic::Instance()->getPostList($topic_id);

        $topic_id = $result['topic_id'];
        $topic_name = $result['topic_name'];
        $post_id_list = $result['post_id_list'];

        //根据某个主题的全部文章id列表,查找出所有的文章信息
        $posts = MPost::Instance()->get_pdetail_By_pid($post_id_list);
        $posts_count = count($posts);

        //查找登录用户的文章里,不在当前主题的post_id_list里的文章列表(用于传递给modal)
        $uid = Auth::id();
        $myposts = MPost::Instance()->get_mypost_notin($uid,$post_id_list);
        $myposts_count = count($myposts);

        $topics = MTopic::Instance()->getSidebar();

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

    //复选框选中的post_id投稿到当前专题中
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
