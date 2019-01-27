<?php
//000000000010
 exit();?>
think_serialize:a:12:{s:2:"id";i:1;s:9:"user_name";s:6:"老白";s:5:"title";s:25:" nginx.conf 配置文件 ";s:4:"cont";s:4148:"[strong]Nginx配置文件主要分成四部分：[/strong][br]
[table][colgroup:2]
[thead]
[tr][th] 方法 [/th][th] 描述 [/th][/tr]
[/thead]
[tbody]
[tr][td] main（全局设置）[/td][td] 将影响其它所有部分的设置；[/td][/tr]
[tr][td] server（主机设置）[/td][td] 主要用于指定虚拟主机域名、IP和端口;[/td][/tr]
[tr][td] upstream（上游服务器设置，主要为反向代理、负载均衡相关配置）[/td][td] 用于设置一系列的后端服务器，设置反向代理及后端服务器的负载均衡；[/td][/tr]
[tr][td] location（URL匹配特定位置后的设置）[/td][td] 用于匹配网页位置（比如，根目录“/”,“/images”,等等）[/td][/tr]
[/tbody]
[/table]
他们之间的关系式：server继承main，location继承server；upstream既不会继承指令也不会被继承。它有自己的特殊指令，不需要在其他地方的应用。
[pre][nginx.conf]
user  www www;
worker_processes  2;

error_log  logs/error.log;
#error_log  logs/error.log  notice;
#error_log  logs/error.log  info;

pid        logs/nginx.pid;

events {
    use epoll;
    worker_connections  2048;
}

http {
    include       mime.types;
    default_type  application/octet-stream;

    #log_format  main  '$remote_addr - $remote_user [$time_local] "$request" '
    #                  '$status $body_bytes_sent "$http_referer" '
    #                  '"$http_user_agent" "$http_x_forwarded_for"';

    #access_log  logs/access.log  main;

    sendfile        on;
    # tcp_nopush     on;

    keepalive_timeout  65;

  # gzip压缩功能设置
    gzip on;
    gzip_min_length 1k;
    gzip_buffers    4 16k;
    gzip_http_version 1.0;
    gzip_comp_level 6;
    gzip_types text/html text/plain text/css text/javascript application/json application/javascript application/x-javascript application/xml;
    gzip_vary on;
  
  # http_proxy 设置
    client_max_body_size   10m;
    client_body_buffer_size   128k;
    proxy_connect_timeout   75;
    proxy_send_timeout   75;
    proxy_read_timeout   75;
    proxy_buffer_size   4k;
    proxy_buffers   4 32k;
    proxy_busy_buffers_size   64k;
    proxy_temp_file_write_size  64k;
    proxy_temp_path   /usr/local/nginx/proxy_temp 1 2;

  # 设定负载均衡后台服务器列表 
    upstream  backend  { 
              #ip_hash; 
              server   192.168.10.100:8080 max_fails=2 fail_timeout=30s ;  
              server   192.168.10.101:8080 max_fails=2 fail_timeout=30s ;  
    }

  # 很重要的虚拟主机配置
    server {
        listen       80;
        server_name  itoatest.example.com;
        root   /apps/oaapp;

        charset utf-8;
        access_log  logs/host.access.log  main;

        #对 / 所有做负载均衡+反向代理
        location / {
            #root   /apps/oaapp;
            #index  index.jsp index.html index.htm;

            #proxy_redirect off;
            # 后端的Web服务器可以通过X-Forwarded-For获取用户真实IP
            proxy_set_header  Host  $host;
            proxy_set_header  X-Real-IP  $remote_addr;  
            proxy_set_header  X-Forwarded-For  $proxy_add_x_forwarded_for;
            proxy_pass        http://backend;  
            #proxy_next_upstream error timeout invalid_header http_500 http_502 http_503 http_504;
        }

        #静态文件，nginx自己处理，不去backend请求tomcat
        location  ~* /download/ {  
            root /apps/oa/fs;  
        }
        location ~ .*\.(gif|jpg|jpeg|bmp|png|ico|txt|js|css)$   
        {   
            root /apps/oaapp;   
            expires      7d; 
        }
       	location /nginx_status {
            stub_status on;
            access_log off;
            allow 192.168.10.0/24;
            deny all;
        }

        location ~ ^/(WEB-INF)/ {   
            deny all;   
        }
        #error_page  404              /404.html;

        # redirect server error pages to the static page /50x.html
        #
        error_page   500 502 503 504  /50x.html;
        location = /50x.html {
            root   html;
        }
    }
  ## 其它虚拟主机，server 指令开始
}
[/pre]";s:6:"to_top";i:0;s:3:"pic";s:58:"/static/head/20170726/e622618cf8c469ef33c5a5e31dc2f58c.png";s:7:"see_num";i:23;s:9:"argue_num";i:0;s:7:"is_best";i:0;s:11:"create_time";s:19:"2018-08-30 22:41:18";s:7:"type_id";i:4;s:4:"type";s:6:"其他";}