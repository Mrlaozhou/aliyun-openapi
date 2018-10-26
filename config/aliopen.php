<?php

return [
    /*
    |--------------------------------------------------------------------------
    | 注册需要的aliyun openapi 组件
    |--------------------------------------------------------------------------
    |
    | 如果下边有的就不用注册
    |
    */
    'autoload'              =>  [
        /**
         * Custom
         */
        'aliyun-php-sdk-vod',

        /**
         * Default
         */
        'aliyun-php-sdk-ecs',
        'aliyun-php-sdk-batchcompute',
        'aliyun-php-sdk-sts',
        'aliyun-php-sdk-push',
        'aliyun-php-sdk-ram',
        'aliyun-php-sdk-ubsms',
        'aliyun-php-sdk-ubsms-inner',
        'aliyun-php-sdk-green',
        'aliyun-php-sdk-dm',
        'aliyun-php-sdk-iot',
        'aliyun-php-sdk-jaq',
        'aliyun-php-sdk-cs',
        'aliyun-php-sdk-live',
        'aliyun-php-sdk-vpc',
        'aliyun-php-sdk-kms',
        'aliyun-php-sdk-rds',
        'aliyun-php-sdk-slb',
        'aliyun-php-sdk-cms',
        'aliyun-php-sdk-idst',
        'aliyun-php-sdk-saf',
        'aliyun-php-sdk-imm',
        'aliyun-php-sdk-mts'
    ],
    /*
    |--------------------------------------------------------------------------
    | Access Key
    |--------------------------------------------------------------------------
    |
    */
    'accessKeyId'           =>  env('ALIYUN_ACCESS_KEY_ID', ''),

    'accessKeySecret'       =>  env('ALIYUN_ACCESS_KEY_SECRET', ''),

    /*
    |--------------------------------------------------------------------------
    | 疑似代理配置
    |--------------------------------------------------------------------------
    |
    | 不懂、而且懒得看的 最好不要修改
    |
    */
    'enable_http_proxy'     =>  false,

    'http_proxy_ip'         =>  '127.0.0.1',

    'http_proxy_port'       =>  8888,
];