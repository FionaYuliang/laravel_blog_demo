<?php

namespace App;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\BaseModel;

class Topic extends BaseModel
{

    public function get_topic_name($topic_id)
    {
        $topic_name = DB::table('topics')->where('id','=',$topic_id)->value('name');

        return $topic_name;

    }

    //根据专题id，获取该专题的文章id列表 post_id_list/pid_list
    public function get_pid_list($topic_id){

        $post_id= DB::table('post_topics')
            ->select('post_id')
            ->where('topic_id','=',$topic_id)
            ->get();

        $raw_pid_list =  $post_id->toArray();

        $pid_list = [];

        foreach($raw_pid_list as $raw_id){
            array_push($pid_list, $raw_id->post_id);
        }

        return  $pid_list;
    }


    //获取专题列表名称
    public function getSidebar()
    {

       $topics =  DB::table('topics')->get();

        return $topics;

    }


}
