<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#">导航</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/posts/index">首页</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/posts/index/create">写文章</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/notices">通知</a>
            </li>
            <li class="nav-item dropdown">
                @if(\Auth::user())
                <a class="nav-link dropdown-toggle" href="#" id="dropdown01"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   {{\Auth::user()->name}}</a>
                <ul class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="/user/{{\Auth::user()->id}}?user_id={{\Auth::user()->id}}">我的首页</a>
                        <a class="dropdown-item" href="/user/me/setting">个人设置</a>
                        <a class="dropdown-item" href="/logout">登出</a>
                    @else
                       <a class="nav-link" href="/login">登录</a>
                    @endif
                </ul>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
