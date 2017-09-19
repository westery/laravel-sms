<?php

return [
    'default' => env('SMS_AGENT', 'NetEase'),

    'agents' => [
        //网易短信
        'NetEase' => [
            'appKey' => env('NETEASE_APPKEY','your netease appkey'),
            'appSecret' => env('NETEASE_APPSECRET','you netease appsecret'),
        ],

    ],
];
