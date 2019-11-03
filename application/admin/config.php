<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    // +----------------------------------------------------------------------
    // | 应用设置
    // +----------------------------------------------------------------------
    'template'               => [
               // 模板后缀
        'view_suffix'  => 'htm',
    ],
    'view_replace_str'  =>  [
    '__PUBLIC__'=>'/public/',
    '__ROOT__' => '/',
    '__ADMIN__' => '/bike/public/static/admin',
    ],
];
