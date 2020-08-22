@extends("layout.main")
@section("content")
<div class="row">
    <div clas="col-md-12">
        <div class="card" style="margin-top: 20px;">
            <div class="card-body">
                <h5 class="card-title">{{$topic_name}}</h5>
                <h6 class="card-subtitle mb-2 text-muted">Topic Description</h6>
                <button class="btn btn-info topic-submit"
                        data-toggle="modal" data-target="#topic_submit_modal"
                        data-topic-id="{{$topic_id}}" _token="MESUY3topeHgvFqsy9EcM916UWQq6khiGHM91wHy">投稿</button>
            </div>
        </div>
    </div>
    <div class="modal fade" id="topic_submit_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">我的文章({{$myposts_count}} 篇)</h4>
            </div>
            @if($myposts_count == 0)
                <div class="modal-body">
                <p>您没有不属于该专题的文章<br/>
                    <a href="http://127.0.0.1:8000/posts/index/create">去写一篇</a></p>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
            </div>
            @else
            <div class="modal-body">
                <form action="/topics/{{$topic_id}}/submit?topic_id={{$topic_id}}" method="POST">
                    @foreach($myposts as $mypost)
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="post_ids[]" value="{{$mypost->id}}">
                            {{$mypost->title}}
                        </label>
                    </div>
                    @endforeach
                    <button type="submit" class="btn btn-default">投稿</button>
                </form>
            </div>
            @endif
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

    <div class="col-sm-8">
        @foreach($posts as $post)
            <div class="media" style="margin-top: 20px;margin-bottom: 20px;">
                <div class="media-body">
                    <h5 class="mt-0"><a href="/posts/{{$post->id}}?post_id={{$post->id}}">{{$post->title}}</a></h5>
                    <p class="mb-2 text-left" style="padding-top: 10px"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
                            <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
                        </svg><a href="/user/{{$post->user_id}}"> {{$post->name}}</a>
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-clock" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm8-7A8 8 0 1 1 0 8a8 8 0 0 1 16 0z"/>
                            <path fill-rule="evenodd" d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                        </svg>   {{$post->created_at}}</p>
                    <p  class="mb-4" style="padding-top: 10px;padding-bottom: 0px;">{{$post->content}}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
