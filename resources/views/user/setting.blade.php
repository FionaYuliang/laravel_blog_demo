@extends("layout.main")
@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="margin-top: 20px;">
                <div class="card-body">
                    <h5 class="card-title text-muted" ">当前用户名:</h5>
                    <h4 class="card-subtitle mb-2" style="padding-top: 20px;">{{\Auth::user()->name}}</h4>
{{--                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>--}}
                  <div class="" style="padding-top: 20px;"
                    <form method="POST">
                      <button class="btn btn-info" >修改用户名</button>
                  </form>
                </div>
                </div>
            </div>
            <div class="card" style="margin-top: 20px;">
                <div class="card-body">
                    <h5 class="card-title text-muted">当前头像</h5>
                    <div class="text-center">
                        <img src="public/avadar.jpg" class="rounded" alt="...">
                    </div>
                    <button class="btn btn-info">修改头像</button>
                </div>
            </div>
        </div>
    </div>
@endsection
