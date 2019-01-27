<?php
namespace app\controller;
use think\Db;
use app\model\Friend;
use app\model\Article;

class Index extends Basic
{
	public function initialize()
	{
		//调用基类初始化
		parent::initialize();
	}

    public function index()
    {
        $data               = $this->data;
        $data['friendLink'] = Friend::getFriendLink();
        $data['see']        = Article::getArticleList([],6,'see_num DESC','id,title,see_num,create_time');
        $data['argue']      = Article::getArticleList([],6,'argue_num DESC','id,title,argue_num,create_time');
    	return view('index',$data);
    }

    public function list(){
        $map = input('type') ? ['type_id'=>input('type')]:[];
        return json(['status'=>0,'data'=>Article::getArticleList($map,0,'','',10)]);
    }

}
