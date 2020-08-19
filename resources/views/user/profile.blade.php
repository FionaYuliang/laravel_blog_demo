@extends('layout.main')
@section('content')
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h4> {{$userInfo['username']}}</h4>
        <p class="lead">关注：{{$userInfo['fan_count']}}｜粉丝：{{$userInfo['star_count']}}｜
            文章：{{$userInfo['post_count']}}</p>
        @include('user.badges.follow',['target_user' => $userInfo])
    </div>
</div>

<nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">文章</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">关注</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">粉丝</a>
            </div>
        </nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
         aria-labelledby="nav-home-tab">
        @foreach($posts as $post)
            <div class="blog-post" style="margin-top: 30px">
                <p><h5><a href="/posts/{{$post->id}}?post_id={{$post->id}}">{{$post->title}}</a>
                    {{$post->created_at}}</h5></p>
                <p>{{$post->content}}</p>
            </div>
        @endforeach
    </div>
    <div class="tab-pane fade" id="nav-profile" role="tabpanel"
    @if($stars_result_list == 0)
        <div class="alert alert-dark" role="alert">该用户还没有关注任何人</div>
    @else
        @foreach($stars_result_list as $star)
            <div class="blog-post" style="margin-top: 30px">
                <p><h5><a href="/user/{{$star['user_id']}}">{{$star['username']}}</a></h5></p>
                <p class="">关注：{{$star['star_count']}} | 粉丝：{{$star['fan_count']}}
                    ｜文章：{{$star['post_count']}}</p>
            </div>
            @include('user.badges.follow',['target_user' => $star])
        @endforeach
    @endif
    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
        @if($fans_result_list == 0)
            <div class="alert alert-dark" role="alert">
                您目前没有粉丝哦 <a href="/posts/index/create" class="alert-link">去写文章</a>
            </div>
        @else
        @foreach($fans_result_list as $fan)
        <div class="blog-post" style="margin-top: 30px">
            <p class=""><a href="{{$fan['user_id']}}">{{$fan['username']}}</a></p>
            <p class="">关注：{{$fan['star_count']}} | 粉丝：{{$fan['fan_count']}}
                ｜文章：{{$fan['post_count']}}</p>
        </div>
        @endforeach
    @endif

    </div>
</div>
@endsection
