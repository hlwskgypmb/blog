<?php /*a:1:{s:39:"/blog/application/view/index/index.html";i:1537431104;}*/ ?>
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
    <link rel="stylesheet" href="/static/res/css/clock.css">
    <link rel="icon" href="/favicon.ico" type="image/x-icon"> 
  </head>
  <body>
    <div class="header">
      <div class="main">
        <a class="logo" href="/" title="">博客</a>
        <div style="position: absolute;left: 160px;">
        <ul class="layui-nav" lay-filter="type">
          <li class="layui-nav-item layui-this" value="0"><a href="javascript:;">全部</a></li>
          <?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li class="layui-nav-item" value="<?php echo htmlentities($vo['id']); ?>"><a href="javascript:;"><?php echo htmlentities($vo['title']); ?></a></li>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        </div>
        <div class="nav-user">
          <?php if($is_login): ?>
            <div class="nav">
              <a href="/add/index"><i class="iconfont icon-fabu" style="top: 0; font-size: 22px;"></i>添加</a>
              <a href="javascript:;" class="pt"><i class="iconfont icon-lianjie" style="top:0;font-size:22px;"></i>扒图</a>
              <a href="/pic/index"><i class="iconfont icon-tupian" style="top: 0; font-size: 22px;"></i>看图</a>
              <a href="/user/logout"><i class="iconfont icon-tuichu" style="top: 0; font-size: 22px;"></i>退出</a>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <div class="main layui-clear">
      <div class="wrap">
        <div class="content">
          <div class="list">
            <ul class="fly-list">
              <li style="text-align:center;">加载中</li>
            </ul>
          </div>
          <div id="page" style="text-align: center">
          </div>
        </div>
      </div>
      <div class="edge">
        <dl class="fly-panel fly-list-one">
          <h3 class="fly-panel-title clock">时间</h3>
            <div id="clock" class="light" style="padding: 5px">
              <div class="display">
                <div class="weekdays"></div>
                <!-- <div class="ampm"></div> -->
                <div class="digits"></div>
              </div>
            </div>
        </dl>
        <dl class="fly-panel fly-list-one">
          <dt class="fly-panel-title">查看</dt>
        <?php if(is_array($see) || $see instanceof \think\Collection || $see instanceof \think\Paginator): $i = 0; $__LIST__ = $see;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <dd>
              <a href="javascript:scrollTo(0,0)" class="details" value="<?php echo htmlentities($vo['id']); ?>"><?php echo htmlentities($vo['title']); ?></a>
              <span><i class="iconfont">&#xe60b;</i> <?php echo htmlentities($vo['see_num']); ?></span>
            </dd>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </dl>

        <dl class="fly-panel fly-list-one"> 
          <dt class="fly-panel-title">回复</dt>
          <?php if(is_array($argue) || $argue instanceof \think\Collection || $argue instanceof \think\Paginator): $i = 0; $__LIST__ = $argue;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <dd>
              <a href="javascript:scrollTo(0,0)" class="details" value="<?php echo htmlentities($vo['id']); ?>"><?php echo htmlentities($vo['title']); ?></a>
              <span><i class="iconfont">&#xe60c;</i> <?php echo htmlentities($vo['argue_num']); ?></span>
            </dd>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </dl>

        <div class="fly-panel fly-link">
          <h3 class="fly-panel-title">友情链接</h3>
          <dl>
            <?php if(is_array($friendLink) || $friendLink instanceof \think\Collection || $friendLink instanceof \think\Paginator): $i = 0; $__LIST__ = $friendLink;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <dd>
              <a href="<?php echo htmlentities($vo['url']); ?>" target="_blank"><?php echo htmlentities($vo['cont']); ?></a>
            </dd>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </dl>
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
<script src="/static/res/moment.js"></script>
<script>
	layui.config({
	  version: "2.0.0"
	  ,base: '/static/res/mods/'
	}).use(['index']);
</script>