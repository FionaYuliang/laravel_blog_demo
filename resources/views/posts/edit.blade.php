
@extends("layout.main")
@section("content")
    <div class="col-sm-8 blog-main">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/posts/{{$post->id}}/update" method="POST">
            {{method_field('POST')}}
            {{csrf_field()}}
            <div class="form-group">
                <label>编辑标题</label>
                <input name="title" type="text" class="form-control" placeholder="{{$post->title}}" value="你好你好">
            </div>
            <div class="form-group">
                <label>编辑内容</label>
                <textarea id="content" name="content" class="form-control" style="height:400px;max-height:500px;"  placeholder="{{$post->content}}}]">
                    <p&gt;{{$post->content}}}
                    </p&gt;
                </textarea>
            </div>
            <button type="submit" class="btn btn-default">更新</button>
        </form>
        <br>
    </div><!-- /.blog-main -->
@endsection
