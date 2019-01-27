<?php
namespace app\model;
use think\Db;
class Friend extends Basic
{
    public static function getFriendLink($field='cont,url')
    {
    	return Db::table('friend_link')->field($field)->where(['is_delete'=>0])->order('order_no')->select();
    }
}
