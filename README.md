# Aliyun-openapi

## Install
To install through Composer, by run the following command:

```bash
composer require "mrlaozhou/aliyun-openapi"
```

#### Laravel

```bash
php artisan vendor:publish --provider="Mrlaozhou\Aliyun\LaravelAliyunServiceProvider"
```

#### 其他
```bash
// 	继承类
\Mrlaozhou\Aliyun\AliyunServiceProvider
//	实现 setAliyunAutoload 方法 (获取要加载的aliyun目录)
//	实现 setAliyunPath 方法 (获取阿里云openapi路径)
```

## Document

### Config

You can modify the provider at will.

Filepath: config/aliopen.php

```php
return = [
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
```


### Using

#### Facade

```bash
 * 获取客户端实例
Aliyun::client();
AliyunVod::cliect();

 * 视频播放
AliyunVod::playInfo ($videoId, $expire=3600*24, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
AliyunVod::createPlayAuth ($videoId,$expire=3600, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')

 * 视频上传
AliyunVod::createUploadAuth (array $videoInfo,$accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
AliyunVod::refreshUploadAuth (string $videoId, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai' )
AliyunVod::createImageUploadAuth ($imageType, $imageExt, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai' )
 
 * 视频管理 
AliyunVod::videoInfo ( $videoId, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai' )
AliyunVod::updateVideoInfo($videoId,array $videoInfo, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
AliyunVod::deleteVideos ($videoIds, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
AliyunVod::videosList (array $wheres,$accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
AliyunVod::deleteStream ($videoId, $jobIds, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai' )
AliyunVod::mezzanineInfo ($videoId, $expire=3600*5, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
 
 * 分类管理
AliyunVod::createCategory (array $attributes,$accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
AliyunVod::updateCategory (array $attribute, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
AliyunVod::deleteCategory (int $cateId, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
AliyunVod::getCategories (array $wheres, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai' )
 *
```