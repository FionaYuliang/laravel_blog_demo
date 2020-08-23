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
    public  function ShowTPostPaginte(Request $request){

        $topic_id =$request->query('topic_id');
        $current_page = $request->query('page');

        $topic_name= MTopic::Instance()->get_topic_name($topic_id);
        $post_id_list =MPost::Instance()->getPidList($topic_id);

        //topic_posts 分页展示
        $tposts = MPost::Instance()->getTPostPaginate($current_page,$post_id_list);
        $tposts_count = count($tposts);
        $max_page = MPost::Instance()->getMaxPage($tposts_count);

        //传递给modal的数据
        $uid = Auth::id();
        $myposts = MPost::Instance()->getMyPosts($uid,$post_id_list);
        $myposts_count = count($myposts);

        //日常引入topics
        $topics = MTopic::Instance()->getSidebar();

        return view('topic/detail', [
            'topics'=>$topics,
            'topic_id'=>$topic_id,
            'topic_name'=>$topic_name,
            'tposts'=>$tposts,
            'tposts_count'=>$tposts_count,
            'myposts'=>$myposts,
            'myposts_count'=>$myposts_count,
            'current_page' => $current_page,
            'max_page' =>$max_page,
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
