<?php


namespace app\admin\model;
use think\Model;

class Cate extends Model
{
    protected $pk = 'id';
    protected $table = 'bk_cate';

    public function cateTree()
    {
        $cates = $this->order("sort desc")->select();
//        $arr = $this->where('pid',0)->order("sort desc")->select();
//        return $this->buildTree2($cates,$arr);
        $res = $this->buildTree($cates);
        return $res;
    }
    public function buildTree($cates,$pid=0,$level=0)
    {
        static $arr = array();//静态数组不会随着方法的结束而被回收
        foreach ($cates as $key => $val)
        {
            if($val['pid'] == $pid)
            {
                $val['level']  = $level;
                $arr[] = $val;
                $this->buildTree($cates,$val['id'],$level+1);
            }
        }
        return $arr;
    }
    private function getTree($array,$pid = 0,$level=0){
        $data = array();
        foreach ($array as $k=>$v){             //PID符合条件的
            if($v['pid'] == $pid){              //寻找子集
                $child = $this->getTree($array,$v['id'],$level+1);            //加入数组
                $v['children'] = $child?:array();
                $data[] = $v;//加入数组中
            }
        }
        return $data;
    }

}

