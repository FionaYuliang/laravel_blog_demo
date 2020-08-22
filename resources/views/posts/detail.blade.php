@extends("layout.main")
@section("content")
<div class="row">
    <div clas="col-md-12">
        <div class="card" style="margin-top: 20px;">
            <div class="card-body">
                <h5 class="card-title">{{$post->title}}</h5>
                <p class="font-weight-normal"><a href="#">{{$post->user_id}}</a>  发表于 {{$post->created_at}}</p>
                <p class="card-text">{{$post->content}}</p>
                <div  class="post-action">
                @if($post->user_id === \Auth::user()->id)
                    <button type="button" class="btn btn-info" data-action-url="/posts/{{$post->id}}/edit">
                        编辑</button>
                    <button type="button" class="btn btn-danger" data-action-url="/posts/{{$post->id}}/delete">
                        删除</button>
                    </a>
                    @else
                   @include('posts.like',['post'=>$post])
                @endif
                </div>

            </div>
        </div>
       <div style="margin-top: 20px;">
           <p>
               <button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#collapseCommentList" aria-expanded="false" aria-controls="collapseCommentList">
                   评论列表({{$comments_count}}条评论)
               </button>
           </p>
           <div class="collapse" id="collapseCommentList">
               <div class="card card-body">
                   <ul class="list-group list-group-flush">
                       @foreach($comments as $comment)
                       <li class="list-group-item">
                           <p class="mb-1>">{{$comment->content}}</p>
                           <small>{{$comment->user_id}} 在 {{$comment->created_at}} 发表评论</small></li>
                       @endforeach
                   </ul>

               </div>
           </div>
       </div>
        <div style="margin-top: 20px;">
    <p>
        <button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#collapseMakeComment" aria-expanded="false" aria-controls="collapseMakeComment">
           发表评论
       </button>
   </p>
   <div class="collapse" id="collapseMakeComment">
       <div class="card card-body">
           <div>
               {{csrf_field()}}
               <div class="form-group">
                   <textarea id="content" row="4" style="height:400px;max-height:500px;" name="content" class="form-control"
                             placeholder="请输入您的评论"></textarea>
               </div>
               <button type="submit" class="btn btn-dark create-comment"
                       data-post-id="{{$post->id}}">评论</button>
           </div>
       </div>
   </div>
</div>
    </div>
</div>
@endsection
