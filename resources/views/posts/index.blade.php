@extends("layout.main")
@section("content")
    <div class="col-md-8" >
        <h3 class="pb-4 mb-4 border-bottom"style="margin-top: 40px">
            首页文章
        </h3>
    </div>
    @include('posts.pagintionPost',['posts'=>$posts])
    <div class="col-md-8 blog-main">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                @if($current_page != 1)
                <li class="page-item">
                    <a class="page-link" href="/posts/index?page={{$current_page - 1 }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                @endif
                @for($page_num=1;$page_num < $max_page;$page_num++)
                    @if($page_num === $current_page)
                        <li class="page-item disabled" aria-disabled="true"><a class="page-link" href="/posts/index?page={{$page_num}}">{{$page_num}}</a></li>
                    @else
                        <li class="page-item"><a class="page-link" href="/posts/index?page={{$page_num}}">{{$page_num}}</a></li>
                    @endif
                @endfor
                @if($current_page != $max_page)
                <li class="page-item">
                    <a class="page-link" href="/posts/index?page={{$current_page + 1}}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
    </div>
@endsection
