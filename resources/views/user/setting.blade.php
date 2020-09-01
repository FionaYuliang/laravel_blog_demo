@extends("layout.main")
@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="margin-top: 20px;">
                <div class="card-body">
                    <h5 class="card-title text-muted" ">当前用户名:</h5>
                    <h4 class="card-subtitle mb-2" style="padding-top: 20px;">{{\Auth::user()->name}}</h4>
{{--                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>--}}
                  <div class="" style="padding-top: 20px;">
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#staticBackdrop">
                         修改用户名
                      </button>
                      <!-- Modal -->
                      <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="staticBackdropLabel">请输入新的用户名</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                      <div class="input-group mb-3">
                                          <div class="input-group-prepend">
                                              <span class="input-group-text" id="basic-addon1">@</span>
                                          </div>
                                          <input type="text" class="form-control new-name" placeholder="New Username"
                                              value="" aria-label="New-Username" aria-describedby="basic-addon1">
                                      </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                                      <button type="button" class="btn btn-primary change-name">确定</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
            <div class="card" style="margin-top: 20px;">
                <div class="card-body">
                    <h5 class="card-title text-muted">当前头像</h5>
                    <div class="text-center">
                        <img src="{{$avatar_url ? $avatar_url: 'http://ww1.sinaimg.cn/large/006hVAtMly1giblhmsxqyj30i20i2dfs.jpg'}}" class="rounded" alt="..."
                        style="height: 100px;width: 100px;">
                    </div>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                       修改头像
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">请输入图片网址</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="addon-wrapping">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-image" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M14.002 2h-12a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1zm-12-1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12z"/>
                                                    <path d="M10.648 7.646a.5.5 0 0 1 .577-.093L15.002 9.5V14h-14v-2l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71z"/>
                                                    <path fill-rule="evenodd" d="M4.502 7a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                                                </svg>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control new-avatar" name="new-avater" placeholder="Image URL" aria-label="new-avatar" aria-describedby="addon-wrapping">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                                    <button type="button" class="btn btn-primary change-avatar">确定</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
