@extends("layout.main")
@section("content")
    <div class="blog-main">
@include("layout.errors")

        <form action="/posts/index/store" method="POST">
{{--            <input type="hidden" name="_token" value="{{csrf_token()}}">--}}
            {{csrf_field()}}
            <div class="form-group">
                <label>标题</label>
                <input name="title" type="text" class="form-control" placeholder="这里是标题">
            </div>
            <div class="form-group">
                <label>内容</label>
                <textarea id="content" name="content" class="form-control" style="height:400px;max-height:500px;"  placeholder="请输入文章内容">
                </textarea>
            </div>
            <button type="submit" class="btn btn-default">提交</button>
        </form>
        <br>
    </div><!-- /.blog-main -->
@endsection
