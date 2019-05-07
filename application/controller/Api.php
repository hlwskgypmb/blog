<?php
namespace app\controller;
use app\model\Pic as picModel;
use think\facade\Log;
class Api{

    public function delPic()
    {
        if(!input('?key') || input('key')!='3571'){
            return json(['data'=>[]]);
        }
        $picModer = new picModel();
        $picModer->del(['id'=>input('id')]);
        return json(['status'=>0]);
    }

    public function delPicDetail()
    {
        if(!input('?key') || input('key')!='3571'){
            return json(['data'=>[]]);
        }
        $picModer = new picModel();
        $picModer->delDetail(['id'=>input('id')]);
        return json(['status'=>0]);
    }

    public function getPicList(){
        if(!input('?key') || input('key')!='3571'){
            return json(['data'=>[]]);
        }
        $picModer = new picModel();
        $data = $picModer->field('id,pic,title,like')->where(['is_delete'=>0])->order('id DESC')->select();
        return json($data);
    }

    public function getPicDetail(){
        if(!input('?key') || input('key')!='3571'){
            return json(['data'=>[]]);
        }
        $picModer = new picModel();
        $data = $picModer->getDetailList(['pid'=>input('id')]);
        $res = [];
        foreach ($data as $k => $v) {
        	$res[] =[
        		'url'=>preg_match('/gamersky/', $v['url']) ? "http://pic.tudan.net.cn/base".$v['src'] : "http://pic.tudan.net.cn/mid".$v['src'],
        		'id'=>$v['id']
        	];;
        }
        return json($res);
    }

	public function upload($host='/static/file/',$path='./static/file/')
	{
        config('app_trace',false);
        is_dir($path) ? '' : mkdir($path,0777,true);
        //获取参数
        if ( $file = request()->file('file') ){
            if( $info = $file->validate(['size'=>1024*200,'ext'=>'jpg,png,gif'])->move($path) ){ 
                $array = array(
                    'status'=>0,
                    'url'=>$host.$info->getSaveName()
                );
            }else{
                $array = array(
                    'status'=>200,
                    'msg'=>$file->getError()
                );
            }
        }else{
            $array = array(
                'status'=>200,
                'msg'=>'文件上传失败！'
            );
        }
        return json($array);
	}

    public function getImg(){
        set_time_limit(60*60*2);
        $id      = '';
        $url     = input('url');
        if(preg_match('/gamersky.com/', $url)){
            return $this->getYMImg($url);
        }
        $urlInfo = parse_url($url);
        $data    = [];
        exec("curl -X GET $url -H 'cache-control: no-cache'",$file);
        $file = implode('', $file);
        //
        $title = match('/title.*?\/title/',$file);
        //验证标题
        if(empty($title)){
            return json(['status'=>100,'msg'=>'无title']);
        }
        $title = getTitle($title);

        $images = match('/src=".*?(jpg|png)/',$file);
        //验证图片
        if(!empty($images)){
            foreach ($images as $k => $v) {
                $str = str_replace('src="', '', $v[0]);
                if(!in_array($str, $data)){
                    $data[] = 'https://telegra.ph'.$str;
                }
            }
        }
        $dataStr = json_encode(['title'=>urlencode($title),'url'=>$url,'urls'=>$data]);
        Log::record($dataStr);
        exec("curl -X POST --header 'Content-Type: application/json;charset=UTF-8' -d '$dataStr' 'pic:8080/api/getPic'");
        return json(['status'=>0,'data'=>$title]);
    }

    public function getYMImg(){
        set_time_limit(60*60*2);
        $id      = '';
        $url     = input('url');
        $urlInfo = parse_url($url);
        $data    = [];
        //$file = curl($url,$headers);
        exec("curl -X GET $url -H 'cache-control: no-cache'",$file);
        $file = implode('', $file);
        //
        $title = match('/title.*?\/title/',$file);
        //验证标题
        if(empty($title)){
            return json(['status'=>100,'msg'=>'无title']);
        }
        $title =getTitle($title);
        $images = match('/href=".*?(jpg|png)/',$file);
        //验证图片
        if(!empty($images)){
            foreach ($images as $k => $v) {
            	if(preg_match('/img1.gamersky.com/', $v[0]) && strlen($v[0])<250 && !preg_match('/icon/', $v[0])){
            		$str = str_replace('https://www.gamersky.com/showimage/id_gamersky.shtml?','',str_replace('http://www.gamersky.com/showimage/id_gamersky.shtml?','',str_replace('href="', '', $v[0])));
                    if(!in_array($str, $data)){
                        $data[] = $str;
                    }
            	}
            }
        }
        $break = 0;
        for ($i=2; $i < 200; $i++) {
            if($break>=3){
                break;
            }
            $file = [];
            $nextUrl = getNextUrl($url,$i);
            exec("curl -X GET $nextUrl -H 'cache-control: no-cache'",$file);
            if(!empty($file)){
                $file = implode('', $file);
                $images = match('/href=".*?(jpg|png)/',$file);
                if(!empty($images)){
                    foreach ($images as $k => $v) {
                        if(preg_match('/img1.gamersky.com/', $v[0]) && strlen($v[0])<250 && !preg_match('/icon/', $v[0])){
                            $str = str_replace('https://www.gamersky.com/showimage/id_gamersky.shtml?','',str_replace('http://www.gamersky.com/showimage/id_gamersky.shtml?','',str_replace('href="', '', $v[0])));
                            if(!in_array($str, $data)){
                                $data[] = $str;
                            }
                        }
                    }
                }else{
                    $break++;
                    continue;
                }
            }else{
                $break++;
                continue;
            }
        }
        $dataStr = json_encode(['title'=>urlencode($title),'url'=>$url,'urls'=>$data]);
        Log::record($dataStr);
        exec("curl -X POST --header 'Content-Type: application/json;charset=UTF-8' -d '$dataStr' 'pic:8080/api/getPic'");
        return json(['status'=>0,'data'=>$title]);
    }
}
