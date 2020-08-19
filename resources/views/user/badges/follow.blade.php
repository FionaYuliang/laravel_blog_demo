@if($target_user['user_id'] != \Auth::user()->id)
<div>
    @if(\Auth::user()->hasStar($target_user['user_id']))
    <button class="btn btn-default follow-button" follow-value="1"
            follow-user="{{$target_user['user_id']}}" type="button">取消关注</button>
    @else
    <button class="btn btn-default follow-button" follow-value="0"
            follow-user="{{$target_user['user_id']}}" type="button">关注</button>
    @endif
</div>
@endif
