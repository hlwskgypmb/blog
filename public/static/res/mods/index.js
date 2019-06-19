/**
 */
layui.define(['layer','laypage','code', 'laytpl', 'form', 'upload','element', 'util','edit','clock','layim'], function(exports){
  var $ = layui.jquery
  ,layer = layui.layer
  ,laytpl = layui.laytpl
  ,form = layui.form()
  ,code = layui.code()
  ,util = layui.util
  ,device = layui.device()
  ,element = layui.element()
  ,laypage = layui.laypage
  ,layim = layui.layim
  ,gather = layui.edit;
  var type = 0;
  var pages = $('#page').attr('value');
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

  $('.pt').click(function(){
    var str ='<form class="layui-form" action="">'
            + '<div class="layui-form layui-form-pane">'
            +   '<div class="layui-form-item">'
            +     '<label class="layui-form-label">url</label>'
            +     '<div class="layui-input-block">'
            +       '<input type="text" id="url" name="url" autocomplete="off" class="layui-input">'
            +     '</div>'
            +   '</div>'
            + '</div>';
            +'</form>'
    layer.open({
      title:'扒图',
      btnAlign: 'c',
      shadeClose: true,
      content: str ,//注意，如果str是object，那么需要字符拼接。
      success: function(){
        form.render();
      },
      yes: function(index){
        var url = $('#url').val();
        if(url.length<10){
          layer.close(index);
          return false;
        }
        ajax('/pic/catch',{'url':url},function(){});
        layer.close(index);
      },
    });
  })

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

  //搜索
  $('.fly-search').submit(function(){
    var input = $(this).find('input'), val = input.val();
    if(val.replace(/\s/g, '') === ''){
      return false;
    }
    input.val( input.val() );
  });
  $('.icon-sousuo').on('click', function(){
    $('.fly-search').submit();
  });

  //表单提交
  form.on('submit(*)', function(data){
    var action = $(data.form).attr('action'), button = $(data.elem);
    var index = layer.load(2);
    gather.json(action, data.field, function(res){
      layer.close(index);
      var end = function(){
        if(res.action == 'javascript:;'){
          renderArgue(res.aid);
          $('.argue').val('');
        }
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

  function renderList(data,c){
    var content = '<ul class="fly-list '+c+'">';
    for (var i = 0; i < data.length; i++) {
      content+= '<li class="fly-list-li">'
              +    '<a href="javascript:;" class="fly-list-avatar">'
              +      '<img src="'+data[i].pic+'" alt="">'
              +    '</a>'
              +    '<h2 class="fly-tip">'
              +      '<a class="detail" value="'+data[i].id+'" href="javascript:scrollTo(0,0)">'+data[i].title+'</a>'
              +      (data[i].to_top == 1 ? '<span class="fly-tip-jie">置顶</span>' : '')
              +      (data[i].is_best == 1 ? '<span class="fly-tip-jing">精帖</span>' : '')
              +    '</h2>'
              +    '<p>'
              +      '<span><a href="javascript:;">'+data[i].user_name+'</a></span>'
              +      '<span>'+data[i].create_time+'</span>'
              +      '<span>'+data[i].type+'</span>'
              +      '<span class="fly-list-hint"> '
              +        '<i class="iconfont" title="回答">&#xe60c;</i> '+data[i].argue_num
              +        '<i class="iconfont" title="人气">&#xe60b;</i> '+data[i].see_num
              +      '</span>'
              +    '</p>'
              +  '</li>'
    }
    content += '</ul>';
    return content;
  }

  function getList(type,page,op=false){
	  var index = layer.load(2);
    ajax('/index/list',{'type':type,'page':page},function(res){
        var t = [],s = [],list='';
        data = res.data.data;
        pages = res.data.last_page;
        for (var i = 0; i < data.length; i++) {
          if(data[i].to_top==1){
            t[t.length] = data[i];
          }else{
            s[s.length] = data[i];
          }
        }
        if(t.length>0){
          list += renderList(t,'fly-list-top');
        }
        if(s.length>0){
          list += renderList(s,'');
        }
        if(t.length==0 && s.length==0){
          list += '<ul class="fly-list"><li style="text-align:center;"> 暂无 </li></ul>';
        }
        $('.list').html(list);
        if(op){
          laypage({
            cont: 'page'
            ,pages: pages //得到总页数
            ,skin: '#47bbec'
            ,jump: function(obj,first){
              if(!first){
                getList(type,obj.curr);
              }
            }
          });
        }
        //绑定点击事件
        $('.detail').click(function(){
          var id = $(this).attr('value');
		      var index1 = layer.load(2);
          ajax('/detail/index',{'id':id},function(res){
            $('.content').html(renderDetail(res.data));
            layui.code({about:false});
            layer.close(index1);
            //相册
            layer.photos({
              photos: '#p'
              ,anim: 0
            });
            //加载编辑器
            gather.layEditor({
              elem: '.argue'
            },1);
            //加载评论
            renderArgue(id);
            del();
          })
        });
		layer.close(index);
    });
  }

  $('.details').click(function(){
    var id = $(this).attr('value');
    var index1 = layer.load(2);
    ajax('/detail/index',{'id':id},function(res){
      $('.content').html(renderDetail(res.data));
      layui.code({about:false});
      layer.close(index1);
      //相册
      layer.photos({
        photos: '#p'
        ,anim: 0
      });
      //加载编辑器
      gather.layEditor({
        elem: '.argue'
      },1);
      //加载评论
      renderArgue(id);
      del();
    })
  })

  function del(){
    $('.delete').click(function(){
      var id = $(this).attr('value');
      layer.confirm('确定删除?', {icon: 3, title:'删除文章'}, function(index){
        ajax('/add/doDel',{'id':id},function(res){
          if(res.status==0){
            location.href = '/';
          }else{
            layer.msg(res.msg);
          }
        })
        layer.close(index);
      });
      return false;
    })
  };

  function delArgue(aid){
    $('.delArgue').click(function(){
      var id = $(this).attr('value');
      layer.confirm('确认删除？', function(index){
        ajax('/detail/delArgue', {'id':id}, function(res){
          if(res.status == 0){
            $('.arguelist').html('<li class="fly-none">没有任何评论</li>');
            renderArgue(aid);
          } else {
            layer.msg(res.msg);
          }
          layer.close(index);
        });
      });
    })
  }

  function renderDetail(data){
    var content = '<div class="fly-panel detail-box">';
    if(data==null){
      content += '</div>';
    }else{
      content += '<h1 style="text-align:center;font-size:25px;line-height:30px;">'+data.title+'</h1>'
               +  '<hr>'
               +  '<div class="fly-tip fly-detail-hint" data-id="'+data.id+'">'
               +     '<span class="fly-tip-stick">'+data.date+'</span>'
               +     '<span class="fly-tip-stick" style="margin-left:5px;">'+data.type+'</span>'
               +      (data.to_top == 1 ? '<span class="fly-tip-jie" style="margin-left:5px;">置顶</span>' : '')
               +      (data.is_best == 1 ? '<span class="fly-tip-jing" style="margin-left:5px;">精帖</span>' : '')
               +     '<div class="fly-list-hint">'
               +      (data.is_login == 1 ? '<span style="margin-left:5px;margin-top:2px;border-radius:2px;"><a href="/add/edit?id='+data.id+'">编辑</a></span>':'')
               +      (data.is_login == 1 ? '<span style="margin-left:5px;margin-top:2px;border-radius:2px;" value="'+data.id+'" class="delete"><a href="javascript:;">删除</a></span>':'')
               +       '<i class="iconfont" title="回答">&#xe60c;</i> '+data.argue_num
               +       '<i class="iconfont" title="查看">&#xe60b;</i> '+data.see_num
               +     '</div>'
               +   '</div>'
               +   '<div class="detail-body photos" id="p" style="margin-bottom: 20px;">'+gather.content(data.cont)+'</div>'
               +  '<fieldset class="layui-elem-field layui-field-title" style="text-align: center;">'
               +    '<legend class="legend_color">回帖</legend>'
               +  '</fieldset>'
               +  '<ul class="jieda photos arguelist" id="jieda">'
               +    '<li class="fly-none">没有任何评论</li>'
               +  '</ul>'
               +  '<div class="layui-form layui-form-pane">'
               +     '<form action="/detail/addArgue" method="post">'
               +       '<div class="layui-form-item layui-form-text">'
               +         '<div class="layui-input-block">'
               +           '<textarea name="content" required lay-verify="required" placeholder="我要评论"  class="layui-textarea argue" style="height: 150px;"></textarea>'
               +         '</div>'
               +       '</div>'
               +       '<div class="layui-form-item">'
               +         '<label class="layui-form-label">名称</label>'
               +         '<div class="layui-input-inline">'
               +           '<input type="text" name="name" autocomplete="off" lay-verify="required" placeholder="匿名" class="layui-input">'
               +         '</div>'
               +         '<div class="layui-form-mid layui-word-aux">来一个吊炸天的名字吧 =,= </div>'
               +       '</div>'
               +       '<div class="layui-form-item">'
               +         '<input type="hidden" name="aid" value="'+data.id+'">'
               +         '<button class="layui-btn layui-btn-normal" lay-filter="*" lay-submit>我要评论</button>'
               +       '</div>'
               +     '</form>'
               +   '</div>'
               +'</div>';
    }
    return content;
  }

  function renderArgue(id){
  	ajax('/detail/getArgue',{'id':id},function(res){
      if(res.data.length > 0){
        var content='';
        for (var i = 0; i < res.data.length; i++) {
          content += '<li data-id="'+res.data[i].id+'">'
            +    '<div class="detail-about detail-about-reply">'
            +      '<a class="jie-user" href="javascript:;">'
            +        '<img src="'+res.data[i].pic+'" alt="">'
            +        '<cite>'
            +          '<i>'+res.data[i].user_name+'</i>'
            +        '</cite>'
            +      '</a>'
            +      '<div class="detail-hits">'
            +        '<span>'+res.data[i].create_time+'</span>'
            +      '</div>'
            +    '</div>'
            +    '<div class="detail-body jieda-body">'+gather.content(res.data[i].cont)+'</div>'
            +    '<div class="jieda-reply">'
            +      '<span class="jieda-zan" value="'+res.data[i].id+'"><i class="iconfont icon-zan"></i><em>'+res.data[i].good+'</em></span>'
            +      '<span class="reply" value="'+res.data[i].user_name+'" ><i class="iconfont icon-svgmoban53"></i>回复</span>'
            +      '<div class="jieda-admin">'
            +          '<span class="delArgue" value="'+res.data[i].id+'">删除</span>'
            +      '</div>'
            +    '</div>'
            +  '</li>';
        }
        $('.arguelist').html(content);
        //绑定回复事件
        $('.reply').click(function(){
          var val = $(this).attr('value');
          $('.argue').focus();
          $('.argue').val('@ ' + val);
        });
        //绑定点赞
        $('.jieda-zan').click(function(){
          var othis = $(this), ok = othis.hasClass('zanok');
          var index = layer.load(2);
          ajax('/detail/addZan/',{'ok':ok,'id':othis.attr('value')},function(res){
            layer.close(index);
            if(res.status == 0){
              var zans = othis.find('em').html()|0;
              othis[ok ? 'removeClass' : 'addClass']('zanok');
              othis.find('em').html(ok ? (--zans) : (++zans));
            } else {
              layer.msg(res.msg);
            }
          });
        });
        //
        delArgue(id);
      }
    })
  }

  laypage({
    cont: 'page'
    ,pages: pages //得到总页数
    ,skin: '#47bbec'
    ,jump: function(obj,first){
      getList(type,obj.curr,true);
    }
  });

  element.on('nav(type)', function(elem){
    type = $(elem).attr("value");
    $('.content').html('<div class="list"></div><div id="page" style="text-align: center"></div>')
    getList(type,1,true);
    return false;
  });

  //加载特定模块
  if(layui.cache.page && layui.cache.page !== 'index'){
    var extend = {};
    extend[layui.cache.page] = layui.cache.page;
    layui.extend(extend);
    layui.use(layui.cache.page);
  }

  //加载IM
  // if(!device.android && !device.ios){
  //   var avatar = '/static/image/face'+Math.floor(Math.random()*6 + 1)+'.jpg';
  //   var id =  (new Date()).getTime();
  //   var socket = new WebSocket('ws://swoole.tudan.net.cn');
  //   //连接成功时触发
  //   socket.onopen = function(){
	 //    socket.send(JSON.stringify({
		// 	type: 'ping' //心跳
		// 	,data: ''
		// }));
  //     	//socket.send('XXX连接成功');
		// layim.config({
		//   init: {
		//     //url: '/im/getInit' //接口地址（返回的数据格式见下文）
		//     // ,type: 'get' //默认get，一般可不填
		//     // ,data: {} //额外参数
		//   }
		//   ,brief: true //是否简约模式（如果true则不显示主面板）
		//   ,notice: true
		//   ,mine: {
		//     avatar: avatar        //我的头像
		//     ,content: "你好吗"     //消息内容
		//     ,id: id               //我的id
		//     ,mine: true           //是否我发送的消息
		//     ,username: "游客"+id  //我的昵称
		//   }
		//   //获取群员接口（返回的数据格式见下文）
		//   ,members: {
		//     url: '/im/getMembers' //接口地址（返回的数据格式见下文）
		//     ,type: 'get' //默认get，一般可不填
		//     ,data: {} //额外参数
		//   }
		//   //上传图片接口（返回的数据格式见下文），若不开启图片上传，剔除该项即可
		//   ,uploadImage: {
		//     url: '/im/uploadImage' //接口地址
		//     ,type: 'post' //默认post
		//   }
		// }).chat({
		// 	name: '广场'
		// 	,type: 'group' //群组类型
		// 	,avatar: '/static/image/group.png'
		// 	,id: 1 //定义唯一的id方便你处理信息
		// 	,members: 0 //成员数，不好获取的话，可以设置为0
		// });
		// layim.setChatMin(); //收缩聊天面板
		// //心跳
		// setInterval(function(){
		//   socket.send(JSON.stringify({
		//     type: 'ping' //心跳
		//     ,data: ''
		//   }));
		// }, 10000);
  //   };
  //   //监听收到的消息
  //   socket.onmessage = function(res){
  //     //res = JSON.parse(res);
  //     if(res.type === 'message'){
  //       msg =JSON.parse(res.data);
  //       if(msg.type != 'pong'){
  //     		//console.log(msg);
  //        	layim.getMessage(msg); //res.data即你发送消息传递的数据（阅读：监听发送的消息）
  //        	//手动消息提醒
  //        	$('#layui-layim-min').children('span').html('收到新消息！')
  //        	$('#layui-layim-min').children('img').attr('src',msg.avatar)
  //       }else{
  //       	//console.log(msg);
  //       	$("#onLine").html(msg.data);
  //       }
  //     }
  //     //res为接受到的值，如 {"emit": "messageName", "data": {}}
  //     //emit即为发出的事件名，用于区分不同的消息
  //   };
  //   //监听发送的消息
  //   layim.on('sendMessage', function(res){
  //     res.mine.avatar = avatar;
  //     res.mine.mine = false;
  //     //console.log(res);
  //     var mine = res.mine; //包含我发送的消息及我的信息
  //     //mine的结构如下：
  //     // {
  //     //   avatar: "avatar.jpg" //我的头像
  //     //   ,content: "你好吗" //消息内容
  //     //   ,id: "100000" //我的id
  //     //   ,mine: true //是否我发送的消息
  //     //   ,username: "纸飞机" //我的昵称
  //     // }
  //     var to = res.to; //对方的信息
  //     //to的结构如下：
  //     // {
  //     //   avatar: "avatar.jpg"
  //     //   ,id: "100001"
  //     //   ,name: "贤心"
  //     //   ,sign: "这些都是测试数据，实际使用请严格按照该格式返回"
  //     //   ,type: "friend" //聊天类型，一般分friend和group两种，group即群聊
  //     //   ,username: "贤心"
  //     // }
  //     //监听到上述消息后，就可以轻松地发送socket了，如：
  //     socket.send(JSON.stringify({
  //       type: 'chatMessage' //随便定义，用于在服务端区分消息类型
  //       ,data: res
  //     }));
  //   })
  // }

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

  $('.clock').dblclick(function(){
    location.href = '/user/login.html';
  })

  //图片懒加载

  layui.use('flow', function(flow){
    flow.lazyimg();
  });
  exports('index', gather);
});

