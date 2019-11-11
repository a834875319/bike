<?php


namespace app\admin\controller;


use think\Controller;

class Cate extends Controller
{
    public function lst(){
        $cate = model('Cate');
        $res = $cate -> cateTree();
//        echo (json_encode($res,JSON_UNESCAPED_UNICODE));
        $this->assign("cates",$res);
        return $this->fetch();
    }
    public function add(){
        $cate = model('Cate');
        if(request()->isPost()){
            $data=input('post.');
            $validate = \think\Loader::validate('Cate');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            $add=$cate->save($data);
            if($add){
                $this->success('添加栏目成功！',url('lst'));
            }else{
                $this->error('添加栏目失败！');
            }
        }
        $cateres=$cate->cateTree();
        $this->assign('cateres',$cateres);
        return $this->fetch();
    }
    public function edit(){

        if(request()->isPost())
        {
            $data=input('post.');
            $validate = \think\Loader::validate('Cate');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
            $save=model('Cate')->save($data,['id'=>$data['id']]);
            if($save !== false){
                $this->success('修改栏目成功！',url('lst'));
            }else{
                $this->error('修改栏目失败！');
            }
            return;
        }
        $id=input('id');
        if(empty($id)){
            $this->error("ID不能为空！");
        }
        $cateVO = model('Cate')->find($id);
        $cateres=model('Cate')->catetree();
        $this->assign(array(
            'cateres'=>$cateres,
            'cateVO'=>$cateVO,
        ));
        return view();
    }

    /**
     * 删除菜单
     */
    public function delete()
    {
        echo '删除菜单啦啦啦啦啦';
        die();
    }
}