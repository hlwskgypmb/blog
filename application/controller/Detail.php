<?php
namespace app\controller;
use think\Db;
use app\model\Friend;
use app\model\Article;
class Detail extends Basic
{
	public function initialize()
	{
		//调用基类初始化
		parent::initialize();
	}

    public function index()
    {
    	$id = input('id')?input('id/d'):0;
        $data = Article::getDetail($id);
        $data['is_login'] = session('is_login');
    	return json(['status'=>0,'data'=>$data]);
    }

    public function getArgue()
    {
        $map['article_id'] = input('id');
        $data = Article::getArgue($map);
        return json(['status'=>0,'data'=>$data]);
    }

    public function addArgue()
    {
        $data = array(
            'article_id'=>input('aid'),
            'cont'=>str_replace('<?', '&lt;?', input('content')),
            'user_name'=>input('name'),
            'pic'=>'/static/res/images/avatar/'.rand(0,12).'.jpg',
        );
        if(Article::addarticleArgue($data)){
            Article::addArgueNum(input('aid'));
            return json(['status'=>0,'action'=>'javascript:;','aid'=>input('aid')]);
        }else{
            return json(['msg'=>'评论失败!']);
        }
    }

    public function addZan()
    {
        $id = input('id')?input('id/d'):0;
        $ok = input('ok');
        if(Article::addGood($id,$ok))
        {
            return json(['status'=>0]);
        }else{
            return json(['msg'=>'点赞失败！']);
        }
    }

    public function delArgue()
    {
        $this->checkLogin();
        $id = input('id')?input('id/d'):0;
        if(Article::deleteArgue($id))
        {
            return json(['status'=>0]);
        }else{
            return json(['msg'=>'删除失败！']);
        }
    }
}
