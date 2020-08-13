<?php

namespace App\Admin\Controllers;

use App\AdminUser;
use App\Post;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\True_;

class TopicController extends Controller
{

    //专题列表页
    public  function index()
    {
        $topics = DB::table('topics')
            ->select('*')
            ->orderBy('created_at','desc')
            ->get();

        $topic_count = count($topics);

        return view('admin/topics/index',[
            'topics' =>  $topics,
            'topic_count' => $topic_count]);
    }

    //新增专题页面
    public function create()
    {
        return view('admin/topics/create');
    }

    //新增专题行为
    public function store(Request $request)
    {
        $this->validate(request(),[
            'name' => 'required|string|max:10|min:2',
        ]);

         $topic = new Topic();
         $topic->name= $request->post('name');
         $topic->save();

         return redirect('admin/topics');
    }


    public function delete(Request $request)
    {

        $topic_id= request('topic_id');

        DB::table('topics')->select('*')
            ->where('id','=',$topic_id)
            ->delete();

        return [
            'error' => 0,
            'msg' => '',
        ];
    }
}
