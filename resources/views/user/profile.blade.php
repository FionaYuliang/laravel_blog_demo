@extends('layout.main')
@section('content')
<div class="jumbotron jumbotron-fluid" style="padding-top:20px;padding-bottom: 10px;">
    <div class="container" style="margin-top:30px;margin-bottom: 30px">
        <h4><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
            </svg>{{$userInfo['username']}}</h4>
        <p class="lead">关注：{{$userInfo['fan_count']}}｜粉丝：{{$userInfo['star_count']}}｜
            文章：{{$userInfo['post_count']}}</p>
        <div style="padding-top: 20px;">
            @include('user.badges.follow',['target_user' => $userInfo])
        </div>

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
    <div class="tab-pane fade show active" style="margin-top: 40px;" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        @foreach($posts as $post)
        <div class="media" style="margin-top: 20px;margin-bottom: 20px;">
            <div class="media-body">
                <h5 class="mt-0"><a href="/posts/{{$post->id}}?post_id={{$post->id}}">{{$post->title}}</a></h5>
                <p class="mb-2 text-left text-muted" style="padding-top: 10px">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-clock-history" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>
                        <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/>
                        <path fill-rule="evenodd" d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                    </svg> {{$post->created_at}} </p>
                <p class="mb-4" style="padding-top: 10px;padding-bottom: 0px;">{{$post->content}}</p>
            </div>
        </div>
        @endforeach
    </div>
    <div class="tab-pane fade" id="nav-profile" role="tabpanel">
    @if($stars_result_list == 0)
        <div class="alert alert-dark" role="alert" style="margin-top: 20px;">
            <p class="">还没关注任何人 </p>
        </div>
    @else
        @foreach($stars_result_list as $star)
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <p><h5><a href="/user/{{$star['user_id']}}">{{$star['username']}}</a></h5></p>
                    <p class="">关注：{{$star['star_count']}} | 粉丝：{{$star['fan_count']}}
                        ｜文章：{{$star['post_count']}}</p>
                </li>
            </ul>
            @include('user.badges.follow',['target_user' => $star])
        @endforeach
    @endif
    </div>
    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
        @if($fans_result_list == 0)
            <div class="alert alert-dark" role="alert" style="margin-top: 20px;">
                <p class="">还没有粉丝</p>
                @if($userInfo['user_id'] === \Auth::user()->id)
                <p class="text-left" style="padding-top: 10px;"> <a href="/posts/index/create" class="alert-link">去写文章</a></p>
                 @endif
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
