<?php
namespace app\controller;
use think\Controller;
use app\model\Article;
class Basic extends Controller
{
	protected $data = [];	//返回数据主体

	public function initialize()
	{
		$this->data['title'] = 'Blake的博客';
        $this->data['type'] = Article::getType();
        if( session('is_login') )
        {
            $this->data['is_login'] = true;
        }else{
            $this->data['is_login'] = false;
        }
	}

    public function checkLogin()
    {
        if( !session('is_login') ) {
            $this->redirect('/user/login');
        }
    }

    public function getToken()
    {
        $token = vertify();
        session('token',$token);
        return $token;
    }

    public function checkToken()
    {
        $i = input('token');
        if($i != session('token')){
            return json(['msg'=>'请刷新后再做提交！']);
        }else{
            session('token',null);
        }
    }

    public function getVertify()
    {
        $m = rand(1,20);
        $n = rand(1,20);
        if( rand(0,1) ){
            $str = "$m + $n = ?";
            session('vertify',$n+$m);
        }else{
            if($m >= $n){
                $str = "$m - $n = ?";
                session('vertify',$m-$n);
            }else{
                $str = "$n - $m = ?";
                session('vertify',$n-$m);
            }
        }
        return $str;
    }

    public function checkVertify()
    {
        $res = '';
        $i   = input('vercode');
        if($i != session('vertify')){
            return json(['msg'=>'验证码错误！']);
        }
    }

    public function _empty()
    {
        return json(['msg'=>'error']);
    }

    public function curl($url='',$data=[],$time=10)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $time);
        if(empty($data)){
            curl_setopt($ch, CURLOPT_HEADER, 0);
        }else{
            // post数据
            curl_setopt($ch, CURLOPT_POST, 1);
            // post的变量
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        $output = curl_exec($ch);
        curl_close($ch);
        //打印获得的数据
        return $output;
    }
}
