@extends('admin.layout.main')
@section('content')
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">
                    <div>
                        <div class="alert alert-info" role="alert">
                            项目目前共有 {{$topic_count}} 个专题
                        </div>
                        <a type="button" class="btn " href="/admin/topics/create" >增加专题</a>
                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title">专题列表</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody><tr>
                                <th style="width: 10px">#</th>
                                <th>专题名称</th>
                                <th>操作</th>
                            </tr>
                            @foreach($topics as $topic)
                            <tr>
                                <td>{{$topic->id}}</td>
                                <td>{{$topic->name}}</td>
                                <td>
                                    <button type="button" class="btn btn-block btn-default ordinary-delete"
                                            data-topic-id="{{$topic->id}}">删除</button>
                                </td>
                            </tr>
                            @endforeach
                            </tbody></table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @endsection
