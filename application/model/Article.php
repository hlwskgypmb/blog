<?php
namespace app\model;
use think\Db;
class Article extends Basic
{
    public static function getArticleList($map=[],$limit=10,$order='',$field='',$paginate=0)
    {
    	$map['is_delete'] = 0;
        $order = $order?$order:'to_top DESC,create_time DESC';
    	$field = $field?$field:[
            'id',
            'user_name',
            'title',
            'to_top',
            'pic',
            'see_num',
            'argue_num',
            'is_best',
            'create_time',
            'type'
        ];
    	$sql = Db::table('article a');
    	$sql ->field($field)->where($map)->order($order)->cache(10);
        if($paginate){
            $res = $sql->paginate($paginate);
        }else{
            $limit ? ($sql->limit($limit)) : '';
            $res = $sql ->select();
        }
    	return $res;
    }

    public static function getDetail($id=0,$field='')
    {
        $res = [];
        if($id){
            $map['is_delete'] = 0;
            $map['id'] = $id;
            $field = $field?$field:[
                'id',
                'user_name',
                'title',
                'cont',
                'to_top',
                'pic',
                'see_num',
                'argue_num',
                'is_best',
                'create_time',
                'type_id',
                'type'
            ];
            $res =  Db::table('article a')->field($field)->where($map)->cache(10)->find();
            if($res){
                //缓存查看文章。。
                if( !cache('see_'.$id.getIp()) ){
                    Db::table('article')->where($map)->setInc('see_num',1);
                    cache('see_'.$id.getIp(),getIp(),3600);
                }
                //---
                $res['date'] = getTime($res['create_time']);
            }
        }
        return $res?$res:[];
    }

    public static function getArgue($map=[])
    {
        $map['is_delete']=0;
        return  Db::table('article_argue')->where($map)->select();
    }

    public static function addGood($id='',$ok='true')
    {
        if($ok=='true'){
            return  Db::table('article_argue')->where('id',$id)->setDec('good',1);
        }else{
            return  Db::table('article_argue')->where('id',$id)->setInc('good',1);
        }
    }

    public static function addarticleArgue($data=[])
    {
        if( Db::table('article_argue')->where($data)->find() )
        {
            return false;
        }else{
            preg_match("/^@.*? /",$data['cont'],$match);
            if(!empty($match)){
                $name = str_replace(' ','',trim($match[0],'@'));
            }
            return Db::table('article_argue')->insertGetId($data);
        }
    }

    public static function getType($map=[])
    {
        return Db::table('article_type')->field('id,title')->where('is_delete',0)->where($map)->cache(600)->select();
    }

    public static function addarticle($data=[])
    {
        $data['type'] = Db::table('article_type')->where(['id'=>$data['type_id']])->value('title');
        return Db::table('article')->insertGetId($data);
    }

    public static function updatearticle($id=0,$data=[])
    {
        $data['type'] = Db::table('article_type')->where(['id'=>$data['type_id']])->value('title');
        return Db::table('article')->where('id',$id)->update($data);
    }

    public static function addSeeNum($id=0)
    {
        Db::table('article')->where('id',$id)->setInc('see_num');
    }

    public static function addArgueNum($id=0)
    {
        Db::table('article')->where('id',$id)->setInc('argue_num');
    }

    public static function delarticle($id=0)
    {
        return Db::table('article')->where(['is_delete'=>0,'id'=>$id])->update(['is_delete'=>1]);
    }

    public static function deleteArgue($id=0)
    {
        if(Db::table('article_argue')->where(['is_delete'=>0,'id'=>$id])->update(['is_delete'=>1]))
        {
            $a_id = Db::table('article_argue')->where('id',$id)->value('article_id');
            Db::table('article')->where(['id'=>$a_id,'is_delete'=>0])->setDec('argue_num');
            return true;
        }
        return false;
    }

    public static function getArgueList($id=0)
    {
        $res = Db::table('article_argue a')
             ->field(['
                id',
                'cont',
                'user_name',
                'pic',
                'good',
                'create_time'
               ])
             ->where('article_id',$id)
             ->where('is_delete',0)
             ->select();
        return $res;
    }

    public static function getCollectArticle($paginate=15)
    {
        $res = Db::table('article_collect a_c')
             ->field(['a.id','a.title','a_c.create_time'])
             ->join('article a','a.id = a_c.article_id')
             ->where(['a_c.is_delete'=>0,'a.is_delete'=>0])
             ->order('a_c.create_time DESC')
             ->paginate($paginate);
        return $res;
    }
}
