<?php /*a:1:{s:38:"/blog/application/view/pic/detail.html";i:1536058177;}*/ ?>
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
      .cont{
        text-align: center;
      }
      .cont img{
        max-width: 80%;
      }
      @media screen and (max-width: 750px) {
        	.main {
  		    margin: 0px;
  		  }
        	.cont {
  		    margin: 2px;
  		  }
        	.cont img{
  	        max-width: 100%;
  	    }
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
              <a href="/pic/index"><i class="iconfont icon-tupian" style="top:0;font-size:22px;"></i>看图</a>
              <a href="/user/logout"><i class="iconfont icon-tuichu" style="top:0;font-size:22px;"></i>退出</a>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <div class="main layui-clear">
      <div class="cont">
        <?php if(is_array($detail) || $detail instanceof \think\Collection || $detail instanceof \think\Paginator): $i = 0; $__LIST__ = $detail;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
          <img lay-src="<?php echo htmlentities($vo['src']); ?>" /><br>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      </div>
    </div>
    <div class="footer">
      <p>
        2017 &copy;鄂ICP备17001565号 <a href="http://www.tudan.net.cn">tudan.net.cn</a>
      </p>
    </div>
  </body>
</html>
<script src="/static/res/layui/layui.js"></script>
<script>
	layui.config({
	  version: "2.0.0"
	  ,base: '/static/res/mods/'
	}).use(['flow','util','layer'], function(){
    var flow = layui.flow
    ,util = layui.util;
    //右下角固定Bar
    util.fixbar({
      bar1: false
      ,click: function(type){
        if(type === 'bar1'){
          layer.msg('bar1');
        }
      }
    });
    // layer.photos({
    //   photos: '.cont'
    //   ,anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
    // });
    flow.lazyimg();
  });
</script>