<?php

namespace Mrlaozhou\Aliyun;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

abstract class AliyunServiceProvider extends ServiceProvider
{
    protected $corePath      =   __DIR__ . '/Library/aliyun-php-sdk-core';

    /**
     * 加载aliyun openapi核心文件
     */
    protected function includeAliyunFiles ()
    {
        $aliyunOpenapiPath          =   $this->setAliyunPath();
        include_once $aliyunOpenapiPath . '/aliyun-php-sdk-core/Autoloader/Autoloader.php';
        include_once $aliyunOpenapiPath . '/aliyun-php-sdk-core/Regions/EndpointConfig.php';
        include_once $aliyunOpenapiPath . '/aliyun-php-sdk-core/Regions/LocationService.php';
    }

    /**
     * 注册需加载的包
     */
    final protected function registerAutoload ()
    {
        $autoloadCollection         =   collect( $this->setAliyunAutoload() ?: [] );

        $autoloadCollection->every(function ($item) {
            \Autoloader::addAutoloadPath($item);
        });
    }

    /**
     * 注册常量
     */
    protected function registerConstant ()
    {
        define('ENABLE_HTTP_PROXY', config('aliopen.enable_http_proxy', false) );
        define('HTTP_PROXY_IP', config('aliopen.http_proxy_ip', '127.0.0.1') );
        define('HTTP_PROXY_PORT', config('aliopen.http_proxy_port', 8888));
    }

    abstract protected function setAliyunAutoload ();

    abstract protected function setAliyunPath () ;
}