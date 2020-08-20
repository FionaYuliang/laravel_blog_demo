<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Like extends Model
{

    /**
     * 登录用户是否给当前uid点赞了
     * @param $target_uid
     */
    public function haslike($post_id)
    {
        $user_id = \Auth::id();

        $is_like = DB::table('likes')->select('*')
            ->where('post_id', $post_id)
            ->where('user_ud',$user_id)
            ->exists();

        return $is_like;
    }


}
