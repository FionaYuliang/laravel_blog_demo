var E = window.wangEditor
var editor = new E('#content')
// 或者 var editor = new E( document.getElementById('editor') )
editor.create()


$('.follow-button').on( "click", function (event) {
    var target = $(event.target);
    var has_follow = target.attr('follow-value')
    var user_id = target.attr('follow-user');
    if (has_follow === 1) {
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
                console.log("data =>", data)
                if (data.error !== 0) {
                    alert(data.msg);
                    return;
                }

                target.attr('follow-value', 1);
                target.text('取消关注');
                // alert("该刷新页面了");
                // location.reload()
            }
        })
    }
})

//文章评论功能
$('.create-comment').on('click', (event) =>{
    let target = $(event.target);
    let post_id = target.attr("data-post-id");
    let contentEle = document.getElementById("content");
    let $content = $(contentEle)
    let content = $content.val()
    console.log(content);

    $.post("/posts/" + post_id +  "/comments",{
        post_id:post_id,
        content:content,
    }, (data) => {
        if (data.error !== 0){
            alert(data.msg);
        }else{
            location.reload()
        }
    });
    return false;
});


//修改用户名
$('.change-name').on('click', (event) =>{
    let target = $(event.target);
    let new_username = document.getElementsByClassName('new-name');
    let new_name = $(new_username).val();

    $.post("/user/changeName",{
        new_username:new_name,
    }, (data) => {
        if (data.error !== 0){
            alert(data.msg);
        }else{
            location.reload()
        }
    });
    return false;
});



//修改头像

