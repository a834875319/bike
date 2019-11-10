<?php
namespace app\admin\validate;
use think\Validate;
class Cate extends Validate
{

    protected $rule=[
        'catename'=>'unique:cate|require',
        'type'=>'require|number',
        'keywords'=>'require',
        'desc'=>'require',
        'content'=>'require',
        'pid'=>'require|number',
        'sort'=>'require|number',
    ];

    protected $message=[
        'catename.require'=>'栏目名称不得为空！',
        'type.require'=>'栏目类型不得为空！',
        'type.number'=>'栏目类型必须是数字！',
        'keywords.require'=>'栏目关键词不得为空！',
        'desc.require'=>'栏目描述不得为空！',
        'content.require'=>'栏目内容不得为空！',
        'pid.require'=>'父级栏目不得为空！',
        'pid.number'=>'父级栏目必须是数字！',
        'sort.require'=>'排序值不得为空！',
        'sort.number'=>'排序值必须是数字！',
        'catename.unique'=>'栏目名称不得重复！',
    ];

    protected $scene=[
        'add'=>['catename','type','keywords','desc','content','pid','sort'],
        'edit'=>['catename'],
    ];





    

    




   

	












}
