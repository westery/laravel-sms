<?php

return [
    'default' => env('SMS_AGENT', 'NetEase'),

    'agents' => [
        //网易短信
        'NetEase' => [
            'appKey' => env('NETEASE_APPKEY','your netease appkey'),
            'appSecret' => env('NETEASE_APPSECRET','you netease appsecret'),
        ],
        //阿里云短信
        'Aliyun' => [
            'appKey' => env('Aliyun_APPKEY_SMS','your aliyun sms appkey'),
            'appSecret' => env('Aliyun_APPSECRET_SMS','you aliyun sms appsecret'),
            'signName' => env('Aliyun_SIGNNAME','your aliyun sign name'),
            'codeTemplate' => env('Aliyun_SMS_CODE_TPML','your aliyun default code template id')
        ],
    ],
];