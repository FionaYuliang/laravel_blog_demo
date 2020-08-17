@extends('layout.main')
@section('content')
    <div class="row">
        <div class="col-sm-8">
            <blockquote>
                <p><img src="http://ww1.sinaimg.cn/large/006hVAtMly1ggrqevjbcpj30a00a0myw.jpg" alt="" class="img-rounded"
                        style="border-radius:500px; height: 40px">
                    {{$userInfo['username']}}</p>
                <footer>关注：{{$userInfo['fan_count']}}｜粉丝：{{$userInfo['star_count']}}｜
                    文章：{{$userInfo['post_count']}}</footer>
                @include('user.badges.follow',['target_user' => $userInfo])
            </blockquote>

        </div>
        <div class="col-sm-8 blog-main">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">文章</a></li>
                    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">关注</a></li>
                    <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">粉丝</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        @foreach($posts as $post)
                        <div class="blog-post" style="margin-top: 30px">
                            <p class="">
                                <a href="/user/{{$post->user_id}}">{{$post->title}}</a>
                                {{$post->created_at}}</p>
                                <p class=""><a href="/posts/{{$post->id}}" >{{$post->content}}</a></p>
                        </div>
                        @endforeach
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                        @foreach($stars_result_list as $star)
                        <div class="blog-post" style="margin-top: 30px">
                            <p class="">{{$star['username']}}</p>
                            <p class="">关注：{{$star['star_count']}} | 粉丝：{{$star['fan_count']}}
                                ｜文章：{{$star['post_count']}}</p>
                        </div>
                            @include('user.badges.follow',['target_user' => $star])
                        @endforeach
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_3">
                        @foreach($fans_result_list as $fan)
                            <div class="blog-post" style="margin-top: 30px">
                                <p class="">{{$fan['username']}}</p>
                                <p class="">关注：{{$fan['star_count']}} | 粉丝：{{$fan['fan_count']}}
                                    ｜文章：{{$fan['post_count']}}</p>
                            </div>
                        @endforeach
                    </div>
            </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
        </div>
    </div><!-- /.blog-main -->

@endsection
