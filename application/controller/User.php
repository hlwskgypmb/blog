<?php
namespace app\controller;
use think\Db;
use app\model\User as UserModel;
use app\model\Article;
use app\controller\Api;
class User extends Basic
{
    public function initialize()
    {
        //调用基类初始化
        parent::initialize();
    }

    public function login()
    {
        if(request()->isAjax()){
            return ['status'=>1,'msg'=>'未登录！'];
        }
        $data = $this->data;
        $data['title'] = '登录';
        $data['vertify'] = $this->getVertify();
        return view('login',$data);
    }

    public function doLogin()
    {
    	if($res = $this->checkVertify()){
    		return json(['msg'=>$res]);
    	};
        $arr = array(
            'user' => input('email'),
            'passwd' => md5(trim(input('pass'))),
        );
        $res = UserModel::login($arr);
        if($res){
            session('vertify',null);
            return json(['status'=>0,'action'=>'/']);
        }else{
            return json(['status'=>102,'msg'=>'密码错误或账号不存在！']);
        }
    }

    public function logout()
    {
        session('is_login',null);
        $data = $this->data;
        $data['is_login'] = false;
        $data['title'] = '登录';
        $data['vertify'] = $this->getVertify();
        return view('login',$data);
    }

    public function upload()
    {
    	$this->checkLogin();
    	$api = new Api();
    	return $api->upload('/static/head/','./static/head/');
    }
}
