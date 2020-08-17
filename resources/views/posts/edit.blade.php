@extends("layout.main")
@section("content")
    <div class="blog-main">
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
            {{csrf_field()}}
            <div class="form-group">
                <label>编辑标题</label>
                <input name="title" type="text" class="form-control" placeholder="{{$post->title}}">
            </div>
            <div class="form-group">
                <label>编辑内容</label>
                <textarea id="content" name="content" class="form-control" style="height:400px;max-height:500px;"  placeholder="{{$post->content}}}]">
                    <p&gt;{{$post->content}}}</p&gt;
                </textarea>
            </div>
            <button class="btn btn-default post-update" type="submit">更新</button>
        <br>
    </div><!-- /.blog-main -->
@endsection
