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
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                @for($page_num=1;$page_num < $max_page;$page_num++)
                <li class="page-item"><a class="page-link" href="/posts/index?page={{$page_num}}">{{$page_num}}</a></li>
                @endfor
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
@endsection
