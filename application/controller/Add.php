<?php
namespace app\controller;
use think\Db;
use app\model\Article;
class Add extends Basic
{
	public function initialize()
	{
		//调用基类初始化
		parent::initialize();
        $this->checkLogin();
	}

    public function index()
    {
        $data            = $this->data;
        $data['action']  = false;
        $data['title']   = '发布blog';
        $data['type']    = Article::getType();
        $data['token']   = $this->getToken();
        $data['vertify'] = $this->getVertify();
    	return view('add',$data);
    }

    public function edit()
    {
        $id              = input('id/d');
        $data            = $this->data;
        $data['action']  = true;
        $data['title']   = '修改blog';
        $data['type']    = Article::getType();
        $data['vertify'] = $this->getVertify();
        $data['detail']  = Article::getDetail($id);
        $data['token']   = $this->getToken();
        return view('add',$data);
    }

    public function doAdd()
    {
    	if($res = $this->checkVertify()){
    		return json(['msg'=>$res]);
    	};
    	if($res = $this->checkToken()){
    		return json(['msg'=>$res]);
    	};
        $id     = input('id')? input('id/d') : 0;
        $data   = array(
            'title'     =>input('title'),
            'cont'      =>str_replace('<?', '&lt;?', input('content')),
            'type_id'   =>input('type_id'),
            'to_top'    =>input('to_top'),
            'is_best'   =>input('is_best'),
            'user_name' =>session('user.name'),
            'pic'       =>session('user.pic'),
        );
        if($id){
            if(Article::updatearticle($id,$data)){
                $this->sendBd($id);
                return json(['status'=>0,'action'=>'/']);
            }else{
                return json(['status'=>103,'msg'=>'修改失败，或者已完成修改！']);
            }
        }else{
            if($newid = Article::addarticle($data)){
                $this->sendBd($newid);
                return json(['status'=>0,'action'=>'/']);
            }else{
                return json(['status'=>102,'msg'=>'添加失败，或者已完成添加！']);
            }
        }
    }

    public function doDel()
    {
        $id = input('id')? input('id/d') : 0;
        if($id){
            if(Article::delarticle($id)){
                $res = json(['status'=>0]);
            }else{
                $res = json(['msg'=>'删除失败或者已被删除！']);
            }
        }else{
            $res = json(['msg'=>'ID不存在或者未传入！']);
        }
        return $res;
    }

    private function sendBd($id)
    {
        $url = 'https://www.tudan.net.cn/detail/index?id='.$id;
        curl('http://data.zz.baidu.com/urls?site=https://www.tudan.net.cn&token=5qNXf3V42c5SR9Hu',[$url]);
    }
}
