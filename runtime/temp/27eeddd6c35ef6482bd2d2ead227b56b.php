<?php /*a:1:{s:37:"/blog/application/view/pic/index.html";i:1537527231;}*/ ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo htmlentities($title); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
    <meta name="keywords" content="hl,博客,php">
    <meta name="description" content="老白的博客">
    <link rel="stylesheet" href="/static/res/layui/css/layui.css">
    <link rel="stylesheet" href="/static/res/css/global.css">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <style type="text/css">
      .layui-layer-content{
        text-align:center;
      }
      p {
        margin: 0;
        padding: 10px;
      }
      #container {
        width: 100%;
        margin: auto;
      }
      #container > div {
        -webkit-box-shadow: 0 4px 15px -5px #555;
        box-shadow: 0 4px 15px -5px #555;
        background-color: #fff;
        width:220px;
        padding:2px;
        margin:5px;
      }
      #container > div img {
        padding: 0px;
        display: block;
        width: 100%;
      }
    </style>
  </head>
  <body>
    <div class="header">
      <div class="main">
        <a class="logo" href="/" title="">博客</a>
        <div class="nav-user">
          <?php if($is_login): ?>
            <div class="nav">
              <a href="/add/index"><i class="iconfont icon-fabu" style="top:0;font-size:22px;"></i>添加</a>
              <a href="/user/logout"><i class="iconfont icon-tuichu" style="top:0;font-size:22px;"></i>退出</a>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <div class="main layui-clear">
      <div class="wrap">
        <div id="container">

        </div>
      </div>
    </div>
    <div class="footer">
      <p>
        2017 &copy;鄂ICP备17001565号 <a href="http://blog.tudan.net.cn">blog.tudan.net.cn</a>
      </p>
    </div>
  </body>
</html>
<script src="/static/res/layui/layui.js"></script>
<script>
	layui.config({
	  version: "2.0.0"
	  ,base: '/static/res/mods/'
	}).use(['flow','util','layer','form','wall'], function(){
    var flow = layui.flow
    ,util = layui.util
    ,layer = layui.layer
    ,form = layui.form()
    ,$ = layui.jquery;

  function ajax(url,data,func){
    $.ajax({
      data: data,
      timeout: 3000,
      url: url,
      success: function(res){
        if(res.status == 0) {
          func(res.data);
        } else {
          layer.msg(res.msg, {shift: 6});
        }
      }, error: function(e){
        options.error || layer.msg('请求异常，请重试', {shift: 6});
      }
    });
  }

  //右下角固定Bar
  util.fixbar({
    bar1: false
    ,click: function(type){
      if(type === 'bar1'){
        layer.msg('bar1');
      }
    }
  });

  flow.load({
    elem: '#container' //流加载容器
    ,isAuto: true
    ,isLazyimg: true
    ,done: function(page, next){ //加载下一页
      //模拟插入
      ajax('/pic/getStaticPic',{'page':page},function(res){
        var lis = [];
        for(var i = 0; i < res.data.length; i++){
        	//console.log(getType(res.data[i]));
        	var cont = '';
        	if(getType(res.data[i])=='.mp4'){
        		cont = '<video id="video" class="def" autoplay="autoplay" loop="loop" width="100%" height="auto"><source style="width:100%;height:100%;" src="http://blog.tudan.net.cn'+res.data[i]+'" type="video/mp4"></video>';
        	}else{
          		cont = '<img src="http://blog.tudan.net.cn'+res.data[i]+'" />';
        	}
        	lis.push('<div class="grid-item">'+cont+'</div>');
        }
        next(lis.join(''), page < res.last_page);
        $(".grid-item").unbind();
        layer.photos({
          photos: ".grid-item"
          ,anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
        });
        //点击操作
        $('video.def').click(function(){
          var source = $(this).html();
          layer.open({
            type: 1,
            title: false,
            area: 'auto',
            maxWidth:'630px',
            move: '#video',
            shade: 0.8,
            scrollbar: false,
            closeBtn: 0,
            shadeClose: true,
            content: '<video id="video" class="def" autoplay="autoplay" loop="loop" width="100%">'+source+'</video>'
          });
        });
        $('.def').each(function(){
          $(this).removeClass("def");
        });
        //删除操作
        $('button.default').click(function(){
          var button = $(this);
        	var id = button.attr('value');
        	layer.confirm('确定删除?', {icon: 2, title:'删除图组'}, function(index){
  	    		ajax('/pic/del',{'id':id},function(res){
  	    			button.parent('div').addClass('layui-hide');
              		$('#container').pinto();
  	    		});
  			  	layer.close(index);
          });
        });
        $('.default').each(function(){
          $(this).removeClass("default");
        });
        $('#container').pinto();
        setTimeout(function(){
          $('#container').pinto();
        },2000);
      });
    }
  });

   function getType(file){
        var filename=file;
        var type=filename.substring(filename.lastIndexOf("."),filename.length);
        return type;
    }
});
</script>