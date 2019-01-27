<?php
namespace app\model;
use think\Db;
class User extends Basic
{
    public static function login($data=[])
    {
    	$res = Db::table('user')
    		 ->field('id,nick,user,pic')
    		 ->where(['user'=>$data['user'],'passwd'=>$data['passwd'],'is_delete'=>0])
    		 ->find();
    	if($res){
    		session('is_login',true);
    		session('user',['uid'=>$res['id'],'name'=>$res['nick'],'pic'=>$res['pic']]);
    	}
    	return $res;
    }
}
