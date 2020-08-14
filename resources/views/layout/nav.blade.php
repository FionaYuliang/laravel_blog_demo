<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/posts/index">首页<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/posts/index/create">写文章</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="notices">通知</a>
            </li>
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>--}}
{{--            </li>--}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>

        <ul class="nav navbar-nav navbar-right">
            <li><a href="#">消息</a></li>
            <li class="dropdown">
                {{--                    <img src="/storage/9f0b0809fd136c389c20f949baae3957/iBkvipBCiX6cHitZSdTaXydpen5PBiul7yYCc88O.jpeg" --}}
                {{--                         alt="" class="img-rounded" style="border-radius:500px; height: 30px">--}}
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                   role="button" aria-haspopup="true" aria-expanded="false">  {{\Auth::user()->name}}<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/user/{{\Auth::user()->id}}">我的主页</a></li>
                    <li><a href="/user/me/setting">个人设置</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="/logout">登出</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
