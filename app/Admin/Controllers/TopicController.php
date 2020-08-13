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
    public  function index()
    {
        $topics = DB::table('topics')
            ->select('*')
            ->orderBy('created_at','desc')
            ->get();

        return view('admin/topics/index',['topics' =>  $topics]);
    }


    public function create()
    {
        return view('admin/topics/create');
    }

    public function store(Request $request)
    {
        $this->validate(request(),[
            'tname' => 'required|string|max:10|min:2',
        ]);
         $topic = new Topic();
         $topic->name= $request->post('tname');
         $topic->save();

          return redirect('admin/topics/index',['topic'=>$topic]);
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
