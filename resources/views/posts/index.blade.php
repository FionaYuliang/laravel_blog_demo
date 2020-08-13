@extends("base.main")

@section("content")
        <div class="col-sm-8 blog-main">
            <div>
                <div>
                    <div>

                    </div>
                </div>
            </div>
            <div>
                <div class="blog-post">
                    @foreach( $posts as $post)
                    <div class="media">
                        <div class="media-body">
                            <h3 class="media-heading blog-post-title">
                                <a href="/posts/{{$post->post_id}}?post_id={{$post->post_id}}">{{$post->title}}</a></h3>

                            <p class="blog-post-meta"> <a href="/user/{{$post->user_id}}">{{$post->name}}</a>
                                发表于:  {{$post->created_at}}
                            </p>
                            <p>{{$post->content}}</p>
                            <p class="blog-post-meta">
                                <button type="button" class="btn btn-default btn-sm" aria-label="Left Align">
                                    <span class="glyphicon glyphicon-heart" aria-hidden="true"> 10 </span>
                                </button>
                                <button type="button" class="btn btn-default btn-sm" aria-label="Left Align">
                                    <span class="glyphicon glyphicon-comment" aria-hidden="true"> 20 </span>
                                </button>
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
{{--                {{$posts->links()}}--}}

            </div><!-- /.blog-main -->
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li>
                        <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li>
                        <a href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

@endsection
