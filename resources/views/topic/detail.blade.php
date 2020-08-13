@extends("base.main")
@section("content")
    <div class="col-sm-8">
        <blockquote>
            <p>{{$topic_name}}</p>
            <footer>文章：{{$posts_count}}</footer>
            <button class="btn btn-default topic-submit"
                    data-toggle="modal" data-target="#topic_submit_modal"
                    data-topic-id="{{$topic_id}}"
                    _token="MESUY3topeHgvFqsy9EcM916UWQq6khiGHM91wHy"
                    type="submit">投稿</button>
        </blockquote>
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
    <div class="col-sm-8 blog-main">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">文章</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    @foreach($posts as $post)
                    <div class="blog-post" style="margin-top: 30px">
                        <p class=""><a href="/users/{{$post->user_id}}">default name  </a>{{$post->created_at}}</p>
                        <p class=""><a href="/posts/{{$post->id}}">{{$post->title}}</a></p>
                        <p>{{$post->content}}</p>
                    </div>
                    @endforeach
                </div>

            </div>
            <!-- /.tab-content -->
        </div>
    </div>
@endsection
