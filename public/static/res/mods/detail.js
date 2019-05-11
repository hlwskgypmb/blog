/**
 */
layui.define(['layer','laypage', 'form', 'upload', 'util','edit'], function(exports){
  var $ = layui.jquery
  ,layer = layui.layer
  ,form = layui.form()
  ,util = layui.util
  ,device = layui.device()
  ,gather = layui.edit;

  //阻止IE7以下访问
  if(device.ie && device.ie < 8){
    layer.alert('如果您非得使用ie浏览Fly社区，那么请使用ie8+');
  }

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

  layui.focusInsert = function(obj, str){
    var result, val = obj.value;
    obj.focus();
    if(document.selection){ //ie
      result = document.selection.createRange(); 
      document.selection.empty(); 
      result.text = str; 
    } else {
      result = [val.substring(0, obj.selectionStart), str, val.substr(obj.selectionEnd)];
      obj.focus();
      obj.value = result.join('');
    }
  };

  //表单提交
  form.on('submit(*)', function(data){
    var action = $(data.form).attr('action'), button = $(data.elem);
    gather.json(action, data.field, function(res){
      var end = function(){
        if(res.action){
          location.href = res.action;
        } else {
          gather.form[action||button.attr('key')](data.field, data.form);
        }
      };
      if(res.status == 0){
        button.attr('alert') ? layer.alert(res.msg, {
          icon: 1,
          time: 10*1000,
          end: end
        }) : end();
      };
    });
    return false;
  });

  //加载特定模块
  if(layui.cache.page && layui.cache.page !== 'index'){
    var extend = {};
    extend[layui.cache.page] = layui.cache.page;
    layui.extend(extend);
    layui.use(layui.cache.page);
  }

  //加载编辑器
  gather.layEditor({
    elem: '.fly-editor'
  });

  //右下角固定Bar
  util.fixbar({
    bar1: false
    ,click: function(type){
      if(type === 'bar1'){
        layer.msg('bar1');
      }
    }
  });

  //手机设备的简单适配
  var treeMobile = $('.site-tree-mobile')
  ,shadeMobile = $('.site-mobile-shade')

  treeMobile.on('click', function(){
    $('body').addClass('site-mobile');
  });

  shadeMobile.on('click', function(){
    $('body').removeClass('site-mobile');
  });

  //图片懒加载

  layui.use('flow', function(flow){
    flow.lazyimg();
  });

  exports('detail', gather);
});

