/**
 * 编辑器
 */
layui.define(['layer','form'], function(exports){
  var $ = layui.jquery
  ,form = layui.form();

  function ajax(url,data,func){
    $.ajax({
      data: data,
      url: url,
      success: function(res){
        if(res.status == 0) {
          func(res);
        } else {
          layer.msg(res.msg, {shift: 6});
        }
      }, error: function(e){
        options.error || layer.msg('请求异常，请重试', {shift: 6});
      }
    });
  }

  //表单提交
  form.on('submit(*)', function(data){
    ajax('/user/doLogin',data.field,function(res){
      location.href = res.action;
    })
    return false;
  });
});

