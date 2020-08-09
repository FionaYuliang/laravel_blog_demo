<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="RPPMc0lhvtynKELDZljXlz9UZI9uNc55ip1P8GCM">
    <title>AdminLTE 2 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="/adminlte/plugins/daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <script type="text/javascript" src="https://cdn.bootcdn.net/ajax/libs/jquery/3.5.1/jquery.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script type="text/javascript" src="https://upcdn.b0.upaiyun.com/libs/jqueryui/jquery.ui-1.10.3.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
    <script type="text/javascript" src="/js/admin.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

@include('admin.layout.header')
@include('admin.layout.sidebar')
    <!-- Content Wrapper. Contains page content -->
<!-- ./wrapper -->
    @yield('content')
    <div class="control-sidebar-bg"></div>
</div>

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
{{--    <script>--}}
{{--        $.widget.bridge('uibutton', $.ui.button);--}}
{{--    </script>--}}

</body>
</html>
