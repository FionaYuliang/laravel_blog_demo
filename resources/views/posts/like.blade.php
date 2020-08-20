@if(\Auth::user()->haslike($post->id))
    <button type="button" class="btn btn-outline-info post-like" like-status="like_true"
            data-post-id="{{$post->id}}" type="button">已点赞</button>
@else
    <button type="button" class="btn btn-outline-info post-like" like-status="like_false"
            data-post-id="{{$post->id}}" type="button">点赞</button>
@endif
