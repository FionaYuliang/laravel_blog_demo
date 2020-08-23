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


    //获取专题列表名称
    public function getSidebar()
    {

       $topics =  DB::table('topics')->get();

        return $topics;

    }


}
