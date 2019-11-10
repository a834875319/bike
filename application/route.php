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
    '__pattern__' => [
        'name' => '\w+',
    ],
/*    '[hello]'     => [
        ':id'   => ['index/index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/index/hello2', ['method' => 'get'],['name' => '\u4e00-\u9fa5'|'']],
    ],*/
    '[msg]'     => [
        'sendTxt' => ['index/index/sendTxt', [], []],
        'sendImg' => ['index/index/sendImg', [],[]],
    ],
//    'msg/sendTxt'   => ['index/index/sendTxt', [], []],
];