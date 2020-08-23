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

    public function show_myposts($post_id_list){

        //查找登录用户的文章里,不在当前主题的post_id_list里的文章列表(用于传递给modal)
        $uid = Auth::id();
        $myposts = MPost::Instance()->get_myposts($uid,$post_id_list);
        $myposts_count = count($myposts);

        return ['myposts'=>$myposts,'mp_count'=>$myposts_count];
    }

    //专题详情页
    public  function TPostPaginte(Request $request){

        $topic_id =$request->query('topic_id');
        $current_page = $request->query('page');


        $topic_name= MTopic::Instance()->get_topic_name($topic_id);
        $post_id_list = MTopic::Instance()->get_pid_list($topic_id);

        //tpost 分页展示
        $result = MPost::Instance()->get_all_posts($post_id_list);
        $posts = MPost::Instance()->getCpagePost($current_page);

        $tposts_count = $result['total_entry'];
        $max_page = $result['max_page'];

        $mp_result = $this->show_myposts($post_id_list);
        $myposts = $mp_result['myposts'];
        $myposts_count = $mp_result['mp_count'];

        //日常引入topics
        $topics = MTopic::Instance()->getSidebar();

        return view('topic/detail', [
            'topics'=>$topics,
            'posts'=>$posts,
            'myposts'=>$myposts,
            'topic_id'=>$topic_id,
            'topic_name'=>$topic_name,
            'tposts_count'=>$tposts_count,
            'current_page' => $current_page,
            'max_page' =>$max_page,
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
