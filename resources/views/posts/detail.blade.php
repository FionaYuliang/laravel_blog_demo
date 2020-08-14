@extends("layout.main2")
@section("content")
   <div  class="col-sm-8 blog-main">
       <div class="blog-post">
           <div class="panel panel-default">
               <div class="panel-heading">
                   <div>
                       <h3 class="panel-title">{{$post->title}}</h3>
                       <div  class="post-action">
                           @can('update',$post)
                               <a href="/posts/{{$post->id}}/edit">
                                   <span class="glyphicon glyphicon-pencil" aria-hidden="true">编辑</span>
                               </a>
                           @endcan
                           @can('delete',$post)
                               <a href="/posts/{{$post->id}}/delete">
                                   <span class="glyphicon glyphicon-remove" aria-hidden="true">删除</span>
                               </a>
                           @endcan
                       </div>
                   </div>

               </div>
               <div class="panel-body">
                   <p class="blog-post-meta">
                       <a href="#">{{$post->user_id}}</a>  发表于 {{$post->created_at->toFormattedDateString()}}
                   </p>
                   <p>{{$post->content}}</p>
               </div>
               <div>
{{--                   @if($post->like(\Auth::id())->exists())--}}
{{--                       <a href="posts/{{$post->id}}/unzan"--}}
{{--                          type="button" class="btn btn-default btn-lg">取消赞</a>--}}
{{--                   @else--}}
{{--                       <a href="posts/{{$post->id}}/zan"--}}
{{--                          type="button" class="btn btn-primary btn-lg">赞</a>--}}
{{--                       @endif--}}
               </div>
           </div>
       </div>
            {{-- list group--}}
       <div class="panel panel-default">
           <div class="panel-heading">
               <h3 class="panel-title">评论列表（{{$comments_count}}条评论）</h3>
           </div>
           <div class="panel-body">
               <ul class="list-group">
                   @foreach($comments as $comment)
                       <li class="list-group-item">
                           <div>
                               {{$comment->content}}
                           </div>
                           <h6>{{$comment->user_id}} 在 {{$comment->created_at}} 发表评论</h6>

                       </li>
                   @endforeach
               </ul>
           </div>
       </div>

       <div class="panel panel-default">
           <div class="panel-heading">
               <h3 class="panel-title">发表评论</h3>
           </div>
           <div class="panel-body">
               <form action="/posts/{{$post->id}}/comments" method="POST">
                   {{csrf_field()}}
                   <div class="form-group">
                       <textarea id="content" row="4" style="height:400px;max-height:500px;" name="content" class="form-control"
                                 placeholder="请输入您的评论"></textarea>
                   </div>
               <button class="btn btn-default" type="submit">评论</button>
               </form>
           </div>
       </div>
   </div>
@endsection
