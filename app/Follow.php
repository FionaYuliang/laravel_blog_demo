<?php

namespace App;

use App\BaseModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Follow extends BaseModel
{
    /**
     * @return \Illuminate\Databas e\Eloquent\Relations\HasOne
     */
    public function follower()
    {

        return $this->hasOne(\App\User::class,'id','follower_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function following()
    {

        return $this->hasOne(\App\User::class,'id','following_id');
    }


    /**
     * 获取指定uid的关注数
     * @param $uid
     * @return int
     */
    public function getFanNum($uid){
        $counter = DB::table('follows')
            ->select('*')
            ->where("follower_id", "=", $uid)
            ->count();
        return $counter;
    }

    /**
     * 获取指定uid的粉丝数
     * @param $uid
     * @return int
     */
    public function getStarNum($uid){
        $counter = DB::table('follows')
            ->select("*")
            ->where("following_id", "=", $uid)
            ->count();
        return $counter;
    }

}
