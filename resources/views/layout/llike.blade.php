<div>
    @if($post->like(\Auth::id())->exists())
        <a href="posts/{{$post->id}}/unzan"
           type="button" class="btn btn-default btn-lg">取消赞</a>
    @else
        <a href="posts/{{$post->id}}/zan"
           type="button" class="btn btn-primary btn-lg">赞</a>
    @endif
</div>
</div>
