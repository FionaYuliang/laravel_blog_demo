// $.ajaxSetup({
//     header:{
//         'X-CSRT-TOKEN':$('meta[name="csfr-token"]'.attr('content'))
//     }
// });

// 选择元素，为元素，绑定onclick事件， 以及处理函数
// 处理函数（回调函数）内容为
// 当发生点击事件时， 获取被点击的元素， 从被点击元素的属性中， 拿到post-id， 和 post-status
// 请求/hello/world接口，传入post-id和post-status参数， 等待获取接口返回值
// ------------将status提交url给控制层，交由changeStatus函数处理，-----------
//
// 根据接口返回值进行判断
// 如果成功的话，将该数据， 从前端展示中隐藏（删除）
// 如果失败， alert message信息
//

// 1.   点击按钮时
//      2.   发起一个网络请求
//           3.   将该按钮所对应的记录， 改变状态
// 4.   根据服务器响应，执行相应操作


function init(){
//管理后台审批文章行为
$('.post-audit').on('click', (event) =>{
    let target = $(event.target);
    let post_id = target.attr("data-post-id");
    let status = target.attr("data-post-action-status");

    $.post("/admin/posts/" + post_id + "/status",{
        post_id:post_id,
        status:status,
    }, (data) => {
        if (data.error != 0){
            alert(data.msg);
            return;
        }
        target.parent().parent().remove();
    });
});


//删除专题行为
$('.ordinary-delete').on('click', (event) =>{
    if(confirm("sure to delete this topic?") === false){
        return;
    }

    let target = $(event.target);
    let topic_id = target.attr("data-topic-id");

    $.post("/admin/topics/" + topic_id + "/delete",{
        topic_id:topic_id,
    }, (data) => {
        if (data.error != 0){
            alert(data.msg);
            return;
        }
        target.parent().parent().remove();
        window.location.reload();

    });
});


}

$(init)




