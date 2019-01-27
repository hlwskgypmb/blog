<?php
namespace app\model;
use think\Db;

class Pic extends Basic
{

	protected $table = 'pic';

	public function findPic($map){
		$map['is_delete'] = 0;
		return Db::table($this->table)->where($map)->find();
	}

	public function createPic($data){
		return Db::table($this->table)->insertGetId($data);
	}

	public function saveList($data){
		if(!Db::table('pic_detail')->where(['src'=>$data['src']])->find()){
			return Db::table('pic_detail')->insertGetId($data);
		}
		return false;
	}

	public function del($map=[])
	{
		return Db::table($this->table)->where($map)->update(['is_delete'=>1]);
	}

	public function delDetail($map=[])
	{
		return Db::table('pic_detail')->where($map)->update(['is_delete'=>1]);
	}

	public function getPic($paginate=10){
		return Db::table($this->table)->where('is_delete',0)->order('id DESC')->paginate($paginate);
	}

	public function updatePic($map=[],$data=[]){
		return Db::table($this->table)->where($map)->update($data);
	}

	public function getDetail($map=[],$paginate=10){
		$map['is_delete']=0;
		$res = Db::table('pic_detail')->field('id,pid,src')->where($map)->paginate($paginate);
		return $res;
	}

	public function getDetailList($map=[]){
		$map['is_delete']=0;
		$res = Db::table('pic_detail')->field('id,src,url')->where($map)->select();
		return $res;
	}

	public function updateDetail($map=[],$data=[]){
		return Db::table('pic_detail')->where($map)->update($data);
	}

	public function test()
	{
		return Db::table('pic_detail')->column('src');
	}
}