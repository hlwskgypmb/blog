<?php
//000000000010
 exit();?>
think_serialize:a:12:{s:2:"id";i:12;s:9:"user_name";s:6:"老白";s:5:"title";s:22:"php调用curl的方法";s:4:"cont";s:1527:"[pre][code]
&lt;?php
function curl_with_cookie($url,$cookie_file='',$data=''){
    $UserAgent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; .NET CLR 3.5.21022; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_USERAGENT, $UserAgent);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_COOKIE, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSLVERSION, 1);
    curl_setopt($curl, CURLOPT_PROXYAUTH, CURLAUTH_BASIC); //开启代理认证模式
    // curl_setopt($curl, CURLOPT_PROXY, "127.0.0.1"); //本地服务器IP地址
    // curl_setopt($curl, CURLOPT_PROXYPORT, 1080); //本地服务器端口
    // curl_setopt($curl, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5); //使用SOCKS5代理模式
    curl_setopt($curl, CURLOPT_COOKIEFILE , $cookie_file);
    curl_setopt($curl, CURLOPT_COOKIEJAR , $cookie_file);
    if (!empty($data)) {
        curl_setopt($curl, CURLOPT_POST, 1);//post方式提交 
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));//要提交的信息
    }
    $content = curl_exec($curl);
    if ($content === false) {
        echo 'Curl error: ' . curl_error($curl);
        exit();
    }
    curl_close($curl);
    return $content;
}
$cookie_file = dirname(__FILE__).'/cookie.txt';
$cookie_login_file = dirname(__FILE__).'/cookie_login.txt';
[/pre]
";s:6:"to_top";i:0;s:3:"pic";s:58:"/static/head/20170726/e622618cf8c469ef33c5a5e31dc2f58c.png";s:7:"see_num";i:3;s:9:"argue_num";i:0;s:7:"is_best";i:0;s:11:"create_time";s:19:"2019-05-03 10:45:40";s:7:"type_id";i:1;s:4:"type";s:3:"PHP";}