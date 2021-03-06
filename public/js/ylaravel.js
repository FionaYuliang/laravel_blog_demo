var E = window.wangEditor
var editor = new E('#content')
// 或者 var editor = new E( document.getElementById('editor') )
editor.create()

//关注该用户与取消关注该用户
$('.follow-button').on("click", function (event) {
    let target = $(event.target);
    let follow_status = target.attr('follow-status');
    let following_id = target.attr('follow-user');
    if (follow_status === "follow_true") {
        $.post("/user/" + following_id +  "/unfollow",{
            following_id:following_id,
        }, (data) => {
            if (data.error !== 0){
                alert(data.msg);
                return;

            }else{
                target.attr('follow-status', "follow_false");
                target.text('关注该用户');
                location.reload()
            }

            return false;
        });
    } else {
        $.post("/user/" + following_id +  "/follow",{
            following_id:following_id,
        }, (data) => {
            if (data.error !== 0){
                alert(data.msg);
                return;
            }else{
                target.attr('follow-status', "follow_true");
                target.text('取消关注');
                location.reload()
            }

            return false;
        });
    }
})

//文章评论功能
$('.create-comment').on('click', (event) =>{
    let target = $(event.target);
    let post_id = target.attr("data-post-id");
    let contentEle = document.getElementById("content");
    let $content = $(contentEle)
    let content = $content.val()

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

//文章点赞与取消点赞
$('.post-like').on('click',(event) => {
    let target = $(event.target);
    let post_id = target.attr("data-post-id");
    let like_status = target.attr('like-status');

    if(like_status === "like_false"){
        $.post("/posts/" + post_id + "/like",{
            post_id:post_id,
        },(data)=> {
            if(data.error !== 0){
                alert(data.msg);
            }else{
                alert(data.msg);
                target.attr('like_status', "like_true");
                target.text('取消点赞');
                location.reload()
            }
        });
        return false;
    }else {
        $.post("/posts/" + post_id + "/unlike",{
            post_id:post_id,
        },(data)=> {
            if(data.error !== 0){
                alert(data.msg);
            }else{
                alert(data.msg);
                target.attr('like_status', "like_false");
                target.text('点赞');
                location.reload()
            }
        });
        return false;
    }


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

$('.change-avatar').on('click', (event) =>{
    let target = $(event.target);
    let new_avatar = document.getElementsByClassName('new-avatar');
    let avatar_url = $(new_avatar).val();

    $.post("/user/changeAvatar",{
        avatar_url:avatar_url,
    }, (data) => {
        if (data.error !== 0){
            alert(data.msg);
        }else{
            location.reload()
        }
    });
    return false;
});
