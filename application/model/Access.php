<?php
namespace app\model;
use think\Db;
class Access extends Basic
{
    public static function saveIp()
    {
    	Db::table('access')->insert(['url'=>request()->server()['REQUEST_URI'],'ip'=>request()->server()['HTTP_X_REAL_IP']]);
    }
}