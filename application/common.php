<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

function curl($url='',$data=false,$time=10,$header=false)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, $time);
    if(!$data){
        curl_setopt($ch, CURLOPT_HEADER, 0);
    }else{
    	//设置heaader
    	if($header){
    		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    	}
        // post数据
        curl_setopt($ch, CURLOPT_POST, 1);
        // post的变量
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        //print_r($data);
        //返回 header
        //curl_setopt($ch, CURLOPT_HEADER, 1);
        //输出 headder
    	curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    }
    $output = curl_exec($ch);
    //输出 header
    //curl_getinfo($ch, CURLINFO_HEADER_OUT),"\r\n";
    curl_close($ch);
    //打印获得的数据
    //$res = simplexml_load_string($output)->ResponseCode;
    return $output;
}

function getTime($date='')
{
	$time  = time();
	$_time = strtotime($date);
	$i     = $time - $_time;
	if($i > 60*60*24*30){
		$str = $date;
	}
	if($i >= 60*60*24){
		$str = (($i/60/60/24)|0) . '天前';
	} else if($i >= 60*60){
		$str = ( ($i/60/60)|0 ) . '小时前';
	} else if($i >= 60*5){
		$str = (($i/60)|0) . '分钟前';
	} else {
		$str = '刚刚';
	}
	return $str;
}

function getIP(){
	if(!empty($_SERVER["HTTP_CLIENT_IP"])){
	  $cip = $_SERVER["HTTP_CLIENT_IP"];
	}
	elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
	  $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	}
	elseif(!empty($_SERVER["REMOTE_ADDR"])){
	  $cip = $_SERVER["REMOTE_ADDR"];
	}
	else{
	  $cip = "无法获取！";
	}
	return $cip;
}

function getExt($path='')
{
	$arr = $path ? pathinfo($path) : [] ;
	return array_key_exists('extension', $arr) ? $arr['extension'] : '';
}

//生成4位验证码
function vertify($length=4)
{
	$chars = "0123456789";
	$str = "";
	for ($i = 0; $i < $length; $i++) {
		$str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
	}
	return $str;
}

function match($preg='',$file=''){
	$matchs = [];
    preg_match_all($preg,$file,$matchs,PREG_SET_ORDER);
    return $matchs;
}

function getTitle($title=''){
	!empty($title[0]) ? ($title = $title[0][0]):'';
	$title = str_replace('title&gt;', '', $title);
	$title = str_replace('title>', '', $title);
	$title = str_replace('&lt;/title', '', $title);
	$title = str_replace('</title', '', $title);
	return $title;
}

function getUrl($src='',$name='',$title='',$des='/static/images/base/'){
	$url = $des.md5($title).'/';
	is_dir('.'.$url) ? '' : mkdir('.'.$url,0777,true);
	if(!is_file('.'.$url.$name)){
		try {
			file_put_contents('.'.$url.$name, fopen($src,'r'));
			thumbPic($url.$name,$name,'/static/images/mid/'.md5($title).'/',550);
		} catch (Exception $e) {
			return '';
		}
	}
	usleep(50000);
	return md5($title).'/'.$name;
}

function thumbPic($src='',$name='',$drc='',$size=300){
	try {
		$image  = \think\Image::open('.'.$src);
		$width  = $image -> width();
		$height = $image -> height() / ($width/$size);
		$res    = $drc.$name;
		is_dir('.'.$drc) ? '' : mkdir('.'.$drc,0777,true);
		$image -> thumb($size, $height,6)->save('.'.$res);
	} catch (Exception $e) {
		$res = $src;
	}
	return $res;
}


function getNextUrl($url='',$no=2){
	$res = '';
	$urlInfo = parse_url($url);
	$res = $urlInfo['scheme'].'://'.$urlInfo['host'];
	$base = explode('/',substr($urlInfo['path'], 1));
	foreach ($base as $k => $v) {
		if($k==(count($base)-1)){
			$expl = explode('.', $v);
			$res .= '/'.$expl[0].'_'.$no.'.'.$expl[1];
		}else{
			$res .= '/'.$v;
		}
	}
	return $res;
}
