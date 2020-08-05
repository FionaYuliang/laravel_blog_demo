<?php
Route::group(['prefix'=>'admin'], function(){
   //登录展示页面
    Route::get('/login','\App\Admin\Controllers\LoginController@index');
    //登录行为
    Route::post('/login','\App\Admin\Controllers\LoginController@login');

    // 登出行为
    Route::get('/logout','\App\Admin\Controllers\LoginController@logout');



    //home page
    Route::group(['middleware'=>'auth:admin'],function(){
        //首页
        Route::get('/home','\App\Admin\Controllers\HomeController@index');

        //管理人员模块
        Route::get('/user','\App\Admin\Controllers\UserController@index');
        Route::get('/user/create','\App\Admin\Controllers\UserController@create');
        Route::post('/user/store','\App\Admin\Controllers\UserController@store');

        //管理文章列表
        Route::get('/posts','\App\Admin\Controllers\PostController@index');
        //操作文章列表
        Route::post('/posts/{post}/status','\App\Admin\Controllers\UserController@changeStatus');
    });


});
