var E = window.wangEditor
var editor = new E('#content')
// 或者 var editor = new E( document.getElementById('editor') )
editor.create()


$('.follow-button').on( "click", function (event) {
    var target = $(event.target);
    var current_mode = target.attr('follow-value');
    var user_id = target.attr('follow-user');
    if (current_mode === 1) {
        $.ajax({
            url: "/user/" + user_id + "/unfollow",
            method: 'POST',
            dataType: "json",
            success: function (data) {
                if (data.error !== 0) {
                    alert(data.msg);
                    return;
                }

                target.attr('follow-value', 0);
                target.text('关注');
            }
        })
    } else {
        $.ajax({
            url: "/user/" + user_id + "/follow",
            method: 'POST',
            dataType: "json",
            success: function (data) {
                if (data.error !== 0) {
                    alert(data.msg);
                    return;
                }

                target.attr('follow-value', 1);
                target.text('取消关注');
            }
        })
    }
})
