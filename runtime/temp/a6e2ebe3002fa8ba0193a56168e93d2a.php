<?php /*a:1:{s:38:"/blog/application/view/user/login.html";i:1536737177;}*/ ?>
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
  </head>
  <body>
    <div class="header">
      <div class="main">
        <a class="logo" href="/" title="">博客</a>
        <div class="nav-user">
          <?php if($is_login): ?>
            <!-- 登入后的状态 -->
            <div class="nav">
              <a href="/user/logout"><i class="iconfont icon-tuichu" style="top: 0px; font-size: 22px;"></i>退出</a>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
	<div class="main layui-clear">
	  <div class="fly-panel fly-panel-user" pad20>
	    <div class="layui-tab layui-tab-brief">
	      <ul class="layui-tab-title">
	        <li class="layui-this">登入</li>
	      </ul>
	      <div class="layui-form layui-tab-content" id="LAY_ucm" style="padding: 20px 0;">
	        <div class="layui-tab-item layui-show">
	          <div class="layui-form layui-form-pane">
	            <form class="layui-form">
	              <div class="layui-form-item">
	                <label for="L_email" class="layui-form-label">邮箱</label>
	                <div class="layui-input-inline">
	                  <input type="text" id="L_email" name="email" required lay-verify="required" autocomplete="on" class="layui-input">
	                </div>
	              </div>
	              <div class="layui-form-item">
	                <label for="L_pass" class="layui-form-label">密码</label>
	                <div class="layui-input-inline">
	                  <input type="password" id="L_pass" name="pass" required lay-verify="required" autocomplete="off" class="layui-input">
	                </div>
	              </div>
	              <div class="layui-form-item">
	                <label for="L_vercode" class="layui-form-label">人类验证</label>
	                <div class="layui-input-inline">
	                  <input type="text" id="L_vercode" name="vercode" required lay-verify="required" placeholder="请回答后面的问题" autocomplete="off" class="layui-input">
	                </div>
	                <div class="layui-form-mid">
	                  <span style="color: #c00;"><?php echo htmlentities($vertify); ?></span>
	                </div>
	              </div>
	              <div class="layui-form-item">
	                <button class="layui-btn" lay-filter="*" lay-submit>立即登录</button>
	                <!-- <span style="padding-left:20px;">
	                  <a href="/user/forget">忘记密码？</a>
	                </span> -->
	              </div>
	            </form>
	          </div>
	        </div>
	      </div>
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
	}).use('login');
</script>