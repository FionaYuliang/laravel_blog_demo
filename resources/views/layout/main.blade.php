<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Laravel Blog</title>
    <!-- Bootstrap core CSS -->
    <link href="/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/jumbotron.css" rel="stylesheet">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>
<body>
@include('layout.nav')
{{--<div class="container">--}}
{{--    <header class="blog-header py-3">--}}
{{--        <div class="row flex-nowrap justify-content-between align-items-center">--}}
{{--            <div class="col-4 pt-1">--}}
{{--                <a class="text-muted" href="#">Subscribe</a>--}}
{{--            </div>--}}
{{--            <div class="col-4 text-center">--}}
{{--                <a class="blog-header-logo text-dark" href="#">Large</a>--}}
{{--            </div>--}}
{{--            <div class="col-4 d-flex justify-content-end align-items-center">--}}
{{--                <a class="text-muted" href="#" aria-label="Search">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24" focusable="false"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>--}}
{{--                </a>--}}
{{--                <a class="btn btn-sm btn-outline-secondary" href="#">Sign up</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </header>--}}

{{--    <div class="nav-scroller py-1 mb-2">--}}
{{--        <nav class="nav d-flex justify-content-between">--}}
{{--            <a class="p-2 text-muted" href="#">World</a>--}}
{{--            <a class="p-2 text-muted" href="#">U.S.</a>--}}
{{--            <a class="p-2 text-muted" href="#">Technology</a>--}}
{{--            <a class="p-2 text-muted" href="#">Design</a>--}}
{{--            <a class="p-2 text-muted" href="#">Culture</a>--}}
{{--            <a class="p-2 text-muted" href="#">Business</a>--}}
{{--            <a class="p-2 text-muted" href="#">Politics</a>--}}
{{--            <a class="p-2 text-muted" href="#">Opinion</a>--}}
{{--            <a class="p-2 text-muted" href="#">Science</a>--}}
{{--            <a class="p-2 text-muted" href="#">Health</a>--}}
{{--            <a class="p-2 text-muted" href="#">Style</a>--}}
{{--            <a class="p-2 text-muted" href="#">Travel</a>--}}
{{--        </nav>--}}
{{--    </div>--}}

{{--    <div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">--}}
{{--        <div class="col-md-6 px-0">--}}
{{--            <h1 class="display-4 font-italic">Title of a longer featured blog post</h1>--}}
{{--            <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what’s most interesting in this post’s contents.</p>--}}
{{--            <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Continue reading...</a></p>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="row mb-2">--}}
{{--        <div class="col-md-6">--}}
{{--            <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">--}}
{{--                <div class="col p-4 d-flex flex-column position-static">--}}
{{--                    <strong class="d-inline-block mb-2 text-primary">World</strong>--}}
{{--                    <h3 class="mb-0">Featured post</h3>--}}
{{--                    <div class="mb-1 text-muted">Nov 12</div>--}}
{{--                    <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>--}}
{{--                    <a href="#" class="stretched-link">Continue reading</a>--}}
{{--                </div>--}}
{{--                <div class="col-auto d-none d-lg-block">--}}
{{--                    <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-md-6">--}}
{{--            <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">--}}
{{--                <div class="col p-4 d-flex flex-column position-static">--}}
{{--                    <strong class="d-inline-block mb-2 text-success">Design</strong>--}}
{{--                    <h3 class="mb-0">Post title</h3>--}}
{{--                    <div class="mb-1 text-muted">Nov 11</div>--}}
{{--                    <p class="mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>--}}
{{--                    <a href="#" class="stretched-link">Continue reading</a>--}}
{{--                </div>--}}
{{--                <div class="col-auto d-none d-lg-block">--}}
{{--                    <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<main role="main" class="container">
    <div class="col-md-8 blog-main">
        <h3 class="pb-4 mb-4 font-italic border-bottom">
            首页文章
        </h3>
    </div>
    <div class="row">
        <div class="col-md-8 blog-main">
            @yield('content')
        </div>
        <aside class="col-md-4 blog-sidebar">
            @include('layout.aside')
        </aside>
    </div>
    <hr>
</main>
<footer class="container">
    <p>&copy;Yuliang 2020-2022</p>
</footer>
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript" src="/js/wangEditor.js"></script>
<script src="/js/ylaravel.js"></script>
</html>
