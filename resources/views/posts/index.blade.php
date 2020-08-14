@extends("layout.main2")
@section("content")
    <!-- Example row of columns -->
    <div class="row">
        @foreach($posts as $post)
        <div class="col-md-4">
            <h2 class="blog-post-title">
                <a href="/posts/{{$post->post_id}}"> {{$post->title}}</a>
               </h2>
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
            <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
        </div>
        @endforeach
    </div>

@endsection
    {{--<nav class="blog-pagination">--}}
    {{--    <a class="btn btn-outline-primary" href="#">Older</a>--}}
    {{--    <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Newer</a>--}}
    {{--</nav>--}}

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

