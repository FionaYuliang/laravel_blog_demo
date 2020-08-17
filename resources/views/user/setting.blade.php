@extends("layout.main")
@section("content")
    <form class="form-horizontal" action="/user/5/setting" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="RuzO8giZVe3C2PalHpxGydYXKvwqNxMwcxscznAb">
        <div class="form-group">
            <label class="col-sm-2 control-label">用户名</label>
            <div class="col-sm-10">
                <input class="form-control" name="name" type="text" value="{{\Auth::user()->name}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">头像</label>
            <div class="col-sm-4">
                <img  class="preview_img" src="http://ww1.sinaimg.cn/large/006hVAtMly1ghtzjhlvenj30n00n1abn.jpg" alt="" class="img-rounded"
                      style="border-radius:500px;">
                <input class="file-loading preview_input" type="file" value="用户名"
                       style="width:80px" name="avatar">
            </div>
        </div>
        <button type="button" class="btn btn-info">修改</button>
    </form>
@endsection
