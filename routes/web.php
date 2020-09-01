<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//网站首页
Route::get('/',function (){
   return 'hello world';
});
//用户注册页面
Route::get('register', 'RegisterController@index');
//用户注册行为
Route::post('register', 'RegisterController@register');
//用户登录界面
Route::get('login', 'LoginController@index');
//用户登录行为
Route::post('login', 'LoginController@authenticate');
//用户登出行为
Route::get('logout', 'LoginController@logout');


//home page
Route::group(['middleware'=>'auth'],function() {
    //个人中心
    Route::get('user/{user}', 'UserController@profile');
    //关注当前用户,user_id为当前用户的id
    Route::post('user/{user}/follow', 'UserController@follow');
    //取消关注当前用户
    Route::post('user/{user}/unfollow', 'UserController@unfollow');

    //用户个人设置页面
    Route::get('user/me/setting', 'UserController@setting');
    //个人设置行为:修改用户名与头像
    Route::post('user/changeName', 'UserController@changeName');
    Route::post('user/changeAvatar', 'UserController@changeAvatar');


    // Post Model
    //文章列表页
    Route::get('posts/index', 'PostController@index');
    // 文章详情页
    Route::get('posts/{post}', 'PostController@detail');
    //文章评论行为
    Route::post('posts/{post}/comments', 'PostController@comment');
    //文章点赞与取消赞行为
    Route::post('posts/{post}/like', 'PostController@like');
    Route::post('posts/{post}/unlike', 'PostController@unlike');
    //用户创建文章
    Route::get('posts/index/create', 'PostController@create');
    Route::post('posts/index/store', 'PostController@store');
    // 用户编辑文章
    Route::get('posts/{post}/edit', 'PostController@edit');
    Route::post('posts/{post}/update', 'PostController@update');
    //用户删除文章
    Route::get('posts/{post}/delete', 'PostController@delete');

    //专题详情页
    Route::get('topics/{topic}', 'TopicController@TPostPaginte');
    //专题投稿
    Route::post('topics/{topic}/submit', 'TopicController@submit');

    //通知功能
    Route::get('notices', 'NoticeController@index');

});
include_once('admin.php');
