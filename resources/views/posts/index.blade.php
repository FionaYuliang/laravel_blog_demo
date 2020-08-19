@extends("layout.main")
@section("content")
    <div class="col-md-8 blog-main">
        <h3 class="pb-4 mb-4 font-italic border-bottom">
            首页文章
        </h3>
    </div>
@foreach($posts as $post)
    <h4 class="blog-post-title">
        <a href="/posts/{{$post->post_id}}?post_id={{$post->post_id}}"> {{$post->title}}</a>
       </h4>
    <p class="blog-post-meta"> {{$post->created_at}} by<a href="/user/{{$post->user_id}}">{{$post->name}}</p>
    <p>{{$post->content}}</p>
    <p>


        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-heart-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
        </svg>  10
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chat-left-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
        </svg> 20
    </p>
    <p><a class="btn btn-secondary" href="/posts/{{$post->post_id}}?post_id={{$post->post_id}}" role="button">View details &raquo;</a></p>
@endforeach

{{--    <nav class="blog-pagination">--}}
{{--        <a class="btn btn-outline-primary" href="#">Older</a>--}}
{{--        <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Newer</a>--}}
{{--    </nav>--}}
<div class="col-md-8 blog-main">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
@endsection
