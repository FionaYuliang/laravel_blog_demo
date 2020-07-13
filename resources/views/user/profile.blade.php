<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">


    <title>laravel for blog</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="css/blog.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/wangEditor.min.css">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->
</head>
<body>
<div class="blog-masthead">
    <div class="container">
        <ul class="nav navbar-nav navbar-left">
            <li>
                <a class="blog-nav-item " href="/posts">首页</a>
            </li>
            <li>
                <a class="blog-nav-item" href="/posts/create">写文章</a>
            </li>
            <li>
                <a class="blog-nav-item" href="/notices">通知</a>
            </li>
            <li>
                <input name="query" type="text" value="" class="form-control" style="margin-top:10px" placeholder="搜索词">
            </li>
            <li>
                <button class="btn btn-default" style="margin-top:10px" type="submit">Go!</button>
            </li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <div>
                    <img src=" " alt="" class="img-rounded" style="border-radius:500px; height: 30px">
                    <a href="#" class="blog-nav-item dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Kassandra Ankunding2  <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/user/5">我的主页</a></li>
                        <li><a href="/user/5/setting">个人设置</a></li>
                        <li><a href="/logout">登出</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
<div class="container">
    <div class="blog-header">
    </div>
    <div class="row">
        <div class="col-sm-8">
            <blockquote>
                <p><img src="" alt="" class="img-rounded"
                        style="border-radius:500px; height: 40px">
                    {{$userInfo['username']}}</p>
                <footer>关注：{{$userInfo['star_count']}}｜粉丝：{{$userInfo['fan_count']}}｜文章：{{$userInfo['post_count']}}</footer>
            </blockquote>
        </div>
        <div class="col-sm-8 blog-main">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">文章</a></li>
                    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">关注</a></li>
                    <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">粉丝</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        @foreach($posts as $post)
                        <div class="blog-post" style="margin-top: 30px">
                            <p class="">
                                <a href="/user/{{$post->user_id}}"></a>
                                {{$post->created_at}}</p>
                                <p class=""><a href="/posts/{{$post->id}}" >{{$post->content}}</a></p>
                        </div>
                        @endforeach
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                        @foreach($stars_result_list as $star)
                        <div class="blog-post" style="margin-top: 30px">
                            <p class="">{{$star->username}}</p>
                            <p class="">关注：{{$star->star_count}} | 粉丝：{{$star->fan_count}}｜文章：{{$star->post_count}}</p>
                        </div>

                        <button class="btn btn-default like-button"
                            like-value="1" like-user="6" _token="MESUY3topeHgvFqsy9EcM916UWQq6khiGHM91wHy"
                            type="button">取消关注</button>
                        @endforeach
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_3">
                        @foreach($fans_result_list as $fan)
                            <div class="blog-post" style="margin-top: 30px">
                                <p class="">{{$fan->username}}</p>
                                <p class="">关注：{{$fan->star_count}} | 粉丝：{{$fan->fan_count}}｜文章：{{$fan->post_count}}</p>
                            </div>

                            <button class="btn btn-default like-button"
                                    like-value="1" like-user="6" _token="MESUY3topeHgvFqsy9EcM916UWQq6khiGHM91wHy"
                                    type="button">取消关注</button>
                        @endforeach
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
        </div>
        </div><!-- /.blog-main -->
        @include("base.sidebar")
    </div><!-- /.row -->

</div><!-- /.container -->


@include("base.footer")
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/wangEditor.min.js"></script>
    <script src="js/ylaravel.js"></script>

</body>
</html>

