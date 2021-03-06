@extends('admin.layout.main')
@section('content')
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-10 col-xs-6">
                    <div class="box">

                        @if($posts_count != 0)
                        <div>
                            <div class="alert alert-info" role="alert">
                                您目前共有 {{$posts_count}} 篇待审核的文章</div>
                        </div>
                        <div class="box-header with-border">
                            <h3 class="box-title">文章列表</h3>
                        </div>
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tbody><tr>
                                    <th style="width: 10px">#</th>
                                    <th>文章标题</th>
                                    <th>操作</th>
                                </tr>
                                @foreach($posts as $post)
                                <tr>
                                    <td>{{$post->id}}</td>
                                    <td>{{$post->title}}</td>
                                    <td>
                                        <button type="button" class="btn btn-block btn-default post-audit"
                                                data-post-id="{{$post->id}}" data-post-action-status="1">通过</button>
                                        <button type="button" class="btn btn-block btn-default post-audit"
                                                data-post-id="{{$post->id}}" data-post-action-status="-1">拒绝</button>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody></table>
                        </div>
                        @else
                        <div>
                            <div class="alert alert-success" role="alert">目前没有待审核的文章 !</div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <div class="control-sidebar-bg"></div>
</div>
@endsection
