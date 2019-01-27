<?php /*a:1:{s:35:"/blog/application/view/add/add.html";i:1536737160;}*/ ?>
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
            <div class="nav">
              <a href="/user/logout"><i class="iconfont icon-tuichu" style="top: 0; font-size: 22px;"></i>退出</a>
            </div>
          <?php else: ?>
            <!-- 未登入状态 -->
            <a class="unlogin" href="/user/login"><i class="iconfont icon-touxiang"></i></a>
            <span><a href="/user/login">登入</a></span>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <div class="main layui-clear">
      <div class="fly-panel" pad20>
        <div class="layui-form layui-form-pane">
          <form action="/add/doAdd" method="post">
            <div class="layui-form-item">
              <label for="L_title" class="layui-form-label">标题</label>
              <div class="layui-input-block">
                <?php if($action): ?>
                  <input type="text" id="L_title" name="title" required lay-verify="required" autocomplete="off" class="layui-input" value="<?php echo htmlentities($detail['title']); ?>">
                <?php else: ?>
                  <input type="text" id="L_title" name="title" required lay-verify="required" autocomplete="off" class="layui-input">
                <?php endif; ?>
              </div>
            </div>
            <div class="layui-form-item layui-form-text">
              <div class="layui-input-block">
                <?php if($action): ?>
                  <input type="text" hidden name="id" value="<?php echo htmlentities($detail['id']); ?>">
                  <textarea id="L_content" name="content" required lay-verify="required" placeholder="请输入内容" class="layui-textarea fly-editor" style="height: 260px;"><?php echo htmlentities($detail['cont']); ?></textarea>
                <?php else: ?>
                  <textarea id="L_content" name="content" required lay-verify="required" placeholder="请输入内容" class="layui-textarea fly-editor" style="height: 260px;"></textarea>
                <?php endif; ?>
              </div>
              <label for="L_content" class="layui-form-label" style="top: -2px;">描述</label>
            </div>
            <div class="layui-form-item">
              <div class="layui-inline">
                <label class="layui-form-label">所在类别</label>
                <div class="layui-input-block">
                  <select lay-verify="required" name="type_id">
                    <?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo htmlentities($vo['id']); ?>" <?php echo !empty($detail) ? ($vo['id']==$detail['type_id']?'selected' : ''):''; ?> ><?php echo htmlentities($vo['title']); ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                </div>
              </div>
          </div>
            <div class="layui-form-item">
              <div class="layui-inline">
                <label class="layui-form-label">是否置顶</label>
                <div class="layui-input-block">
                  <input type="radio" name="to_top" value="0" title="否" <?php echo !empty($detail['to_top']) ? '' : 'checked'; ?> >
                  <input type="radio" name="to_top" value="1" title="是" <?php echo !empty($detail['to_top']) ? 'checked' : ''; ?> >
                </div>
              </div>
          </div>
            <div class="layui-form-item">
              <div class="layui-inline">
                <label class="layui-form-label">是否精帖</label>
                <div class="layui-input-block">
                  <input type="radio" name="is_best" value="0" title="否" <?php echo !empty($detail['is_best']) ? '' : 'checked'; ?> >
                  <input type="radio" name="is_best" value="1" title="是" <?php echo !empty($detail['is_best']) ? 'checked' : ''; ?> >
                </div>
              </div>
            </div>
            <div class="layui-form-item">
              <label for="L_vercode" class="layui-form-label">人类验证</label>
              <div class="layui-input-inline">
                <input type="text" id="L_vercode" name="vercode" required lay-verify="required" placeholder="请回答后面的问题" autocomplete="off" class="layui-input">
                <input type="text" hidden name="token" value="<?php echo htmlentities($token); ?>">
              </div>
              <div class="layui-form-mid">
                <span style="color: #c00;"><?php echo htmlentities($vertify); ?></span>
              </div>
            </div>
            <div class="layui-form-item">
              <button class="layui-btn layui-btn-normal" lay-filter="*" lay-submit>立即发布</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="footer">
      <p>
        2017 &copy;鄂ICP备17001565号 <a href="http://blog.www.tudan.net.cn">blog.tudan.net.cn</a>
      </p>
    </div>
    <script src="/static/res/layui/layui.js"></script>
    <script>
      layui.config({
        version: "2.0.0"
        ,base: '/static/res/mods/'
      }).use(['detail']);
    </script>
  </body>
</html>