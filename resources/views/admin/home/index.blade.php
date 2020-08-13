@extends('admin.layout.main')
@section('content')
    <div class="jumbotron">
        <h3>管理员 {{\Auth::guard('admin')->user()->name}} ,您好 !</h3>
        <p></p>
        <p><a class="btn btn-primary btn-sm" href="#" role="button">Learn more</a></p>
    </div>
@endsection
