<?php

return [
    'default' => env('SMS_AGENT', 'NetEase'),

    'agents' => [
        //网易短信
        'NetEase' => [
            'appId' => env('NETEASE_APPID','your netease appid'),
            'appKey' => env('NETEASE_APPKEY','you netease appkey'),
        ],

    ],
];
