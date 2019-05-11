<?php
namespace app\controller;
use think\Db;
use app\model\Article;
use app\model\Pic as picModel;
use think\facade\Log;
class Pic extends Basic
{
	public function initialize()
    {
        //调用基类初始化
        parent::initialize();
        $this->checkLogin();
    }

    public function index()
    {
        $data = $this->data;
        $map = [];
        $data['title'] = '看图';
    	return view('index',$data);
    }

    public function get()
    {
        $picModer = new picModel();
        $data = $picModer->getPic(6);
        return json(['status'=>0,'data'=>$data]);
    }

    public function del()
    {
        $picModer = new picModel();
        $picModer->del(['id'=>input('id')]);
        return json(['status'=>0]);
    }

    public function detail()
    {
        $picModer = new picModel();
        $data = $picModer->getDetail(['pid'=>input('id')]);
        return json(['status'=>0,'data'=>$data]);
    }

    public function catch(){
        $url     = input('url');
        $urlInfo = parse_url($url);
        //验证url
        if(!array_key_exists('scheme', $urlInfo)){
            return json(['status'=>100,'msg'=>'url错误！scheme']);
        }
        if(!array_key_exists('host', $urlInfo)){
            return json(['status'=>100,'msg'=>'url错误！host']);
        }
        $this->curl('localhost/api/getImg?url='.$url,[],2);
        return json(['status'=>0]);
    }

    public function getStaticPic(){
        $list = [];
        $page = input('?page')?input('page'):1;
        $size = 10;
        $path = '/static/images';
        $file = scandir('.'.$path);
        foreach ($file as $k => $v) {
            if($v == '.' || $v == '..'){
                continue;
            }
            if(($k-2) >= (($page-1)*$size) && ($k-2)<($page*$size)){
                $list[] = $path.'/'.$v;
            }
        }
        $total = ceil( (count($file)-2)/$size);
        return json(['status'=>0,'data'=>['data'=>$list,'last_page'=>$total]]);
    }
}
