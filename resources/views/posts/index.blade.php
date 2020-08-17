@extends("layout.main")
@section("content")
@foreach($posts as $post)
    <div class="col-md-8 blog-main">
        <h3 class="pb-4 mb-4 font-italic border-bottom">
            首页文章
        </h3>
    </div>
    <h4 class="blog-post-title">
        <a href="/posts/{{$post->post_id}}?post_id={{$post->post_id}}"> {{$post->title}}</a>
       </h4>
    <p class="blog-post-meta"> {{$post->created_at}} by<a href="/user/{{$post->user_id}}">{{$post->name}}</p>
    <p>{{$post->content}}</p>
    <p class="blog-post-meta">
        <button type="button" class="btn btn-default btn-sm" aria-label="Left Align">
            <span class="glyphicon glyphicon-heart" aria-hidden="true"> 10 </span>
        </button>
        <button type="button" class="btn btn-default btn-sm" aria-label="Left Align">
            <span class="glyphicon glyphicon-comment" aria-hidden="true"> 20 </span>
        </button>
    </p>
    <p><a class="btn btn-secondary" href="/posts/{{$post->post_id}}?post_id={{$post->post_id}}" role="button">View details &raquo;</a></p>
@endsection
{{--    <nav class="blog-pagination">--}}
{{--        <a class="btn btn-outline-primary" href="#">Older</a>--}}
{{--        <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Newer</a>--}}
{{--    </nav>--}}

{{--    <nav aria-label="Page navigation">--}}
{{--        <ul class="pagination">--}}
{{--            <li>--}}
{{--                <a href="#" aria-label="Previous">--}}
{{--                    <span aria-hidden="true">&laquo;</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li><a href="#">1</a></li>--}}
{{--            <li><a href="#">2</a></li>--}}
{{--            <li><a href="#">3</a></li>--}}
{{--            <li><a href="#">4</a></li>--}}
{{--            <li><a href="#">5</a></li>--}}
{{--            <li>--}}
{{--                <a href="#" aria-label="Next">--}}
{{--                    <span aria-hidden="true">&raquo;</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </nav>--}}


