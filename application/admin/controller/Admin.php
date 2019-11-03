<?php
namespace app\admin\controller;

use \app\admin\model\Admin as AdminModel;
use think\Controller;
use think\Request;

class Admin extends Controller
{
    public function lst()
    {
        /*EQ 等于（=）
NEQ 不等于（<>）
GT 大于（>）
EGT 大于等于（>=）
LT 小于（<）
ELT 小于等于（<=）
LIKE 模糊查询
    [NOT] BETWEEN （不在）区间查询
    [NOT] IN （不在）IN 查询
EXP 表达式查询，支持SQL语法
        and（默认）
        or
        */
//lallalala ceshiceshi
//          $res = model('admin')->select();

            /*$params = array();
            $params['user_name']=['like','%'.'admin'.'%'];
            $params['password']=['eq','123','AND'];*/
//            $res = db('admin')->where($params)->select();
//            dump($res);

        /*$b=array (
            '0' => Array ( 'jid' => 10,'j名' => 10,'jabstract' => 10,'jprovider' => 10,'jintroduction' => '厉害人物'),
            '1' => Array ( 'jid' => 8 ,'j名' => 8, 'jabstract' => 8, 'jprovider' => 8, 'jintroduction' => '厉害人物')
        );*/
       /* foreach ($res as $k => $v) {
            echo $k.'<br>';
//            print_r($v);
            foreach ($v as $index => $value){
                echo 'key='.$index.' || value='.$value.'<br>';
//                echo $value.'<br>';
            }
        }*/
        /*foreach ($res as $index=>$obj){
            foreach ($obj as $key=>$value){
                echo "Key=" . $key . ", Value=" .$value;
                echo "<br>";
            }

        }*/
        /*die();*/
        $params = input('get.');
/*        $paramArr = input('get.');
        dump($paramArr);
        die();*/
        $res = model('admin')->selectPage($params);
        $this->assign('adminRes',$res);

        return $this->fetch();
    }

 	public function add()
    {
        if (Request::instance()->isPost())
        {
            echo "当前为 POST 请求";
             echo "测试测试 Git更新";
            $data=input('post.');
            $adminModel = model('Admin');
//            $res = db('admin')->insert($data);
            $res =  $adminModel->addAdmin($data);
            if($res)
            {
                $this->success('添加管理员成功',url('lst'));
            }else{
                $this->error('添加管理员失败');
            }
//            dump($res);
            return ;
        }
//        $adminModel = new AdminModel();
//        $adminModel.save();

        return view();
    }
     public function edit()
    {



        return view();
    }


    
}
