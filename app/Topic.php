<?php

namespace App;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\BaseModel;

class Topic extends BaseModel
{
    public function getPostList($topic_id){

        $topic_name = DB::table('topics')
            ->select('name')
            ->where('id','=',$topic_id)
            ->get();

        $post_id= DB::table('post_topics')
            ->select('post_id')
            ->where('topic_id','=',$topic_id)
            ->get();

        $raw_post_id_list =  $post_id->toArray();
        $post_id_list = [];

        //$post_id_list 指的是某个主题的全部文章id列表
        foreach($raw_post_id_list as $raw_id){
            array_push($post_id_list, $raw_id->post_id);
        }
        //获取当前专题的post_id_list

        return [
            'topic_id'=>$topic_id,
            'topic_name' => $topic_name,
            'post_id_list' => $post_id_list];
    }

}
