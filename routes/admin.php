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

        //1.系统管理部分
        //1.1 权限管理模块
        Route::get('/permissions','\App\Admin\Controllers\PermissionController@index');


        //1.2人员管理模块
        Route::get('/users','\App\Admin\Controllers\UserController@index');
        Route::get('/users/create','\App\Admin\Controllers\UserController@create');
        Route::post('/users/store','\App\Admin\Controllers\UserController@store');

        //1.3角色管理模块
        Route::get('/roles','\App\Admin\Controllers\RoleController@index');


        //管理文章列表
        Route::get('/posts','\App\Admin\Controllers\PostController@index');
        //操作文章列表
        Route::post('/posts/{post}/status','\App\Admin\Controllers\PostController@changeStatus');


        //专题管理模块
        Route::get('/topics','\App\Admin\Controllers\TopicController@index');
        //操作专题列表
        Route::get('/topics/create','\App\Admin\Controllers\TopicController@create');
        Route::post('/topics/store','\App\Admin\Controllers\TopicController@store');

        Route::post('/topics/{topic}/delete','\App\Admin\Controllers\TopicController@delete');


        //通知管理模块
        Route::get('/notices','\App\Admin\Controllers\NoticeController@index');

    });



});
