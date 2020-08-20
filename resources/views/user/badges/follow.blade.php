@if($target_user['user_id'] != \Auth::user()->id)
<div>
    @if(\Auth::user()->hasStar($target_user['user_id']))
    <button type="button" class="btn btn-outline-info follow-button" follow-status="follow_true"
        follow-user="{{$target_user['user_id']}}" type="button">取消关注</button>
    @else
    <button type="button" class="btn btn-outline-info follow-button" follow-status="follow_false"
        follow-user="{{$target_user['user_id']}}" type="button">关注该用户</button>
    @endif
</div>
@endif
