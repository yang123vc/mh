<?php

return [
    //蛋壳
    'dk'=>[
        //合作者ID
        'partner'=>'2864',
        'key'=>env('DK_KEY'),
        'sign_type'=>strtoupper('MD5'),
        'input_charset'=>strtolower('utf-8'),
        'transport'=>'http',
        'apiurl'=>'https://pay.danbaiyun.com/',

        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
        'notify_url'=>'http://'.$_SERVER['HTTP_HOST'].'/pay/dk/notify_url',
        'return_url'=> 'http://'.$_SERVER['HTTP_HOST'].'/pay/dk/return_url'
    ]

];
