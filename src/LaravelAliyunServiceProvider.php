<?php

namespace Mrlaozhou\Aliyun;

use Mrlaozhou\Aliyun\Managers\LaravelAliyunManager;
use Mrlaozhou\Aliyun\Managers\LaravelAliyunVodManager;

class LaravelAliyunServiceProvider extends AliyunServiceProvider
{
    public function boot ()
    {
        $this->publishConfig();
    }

    public function register ()
    {
        //  合并配置文件
        $this->mergeConfigFrom( __DIR__ . '/../config/aliopen.php', 'aliopen' );
        //  加载阿里云加载文件
        $this->includeAliyunFiles();
        //  注册自动加载
//        $this->registerAutoload();
        //  声明常量
        $this->registerConstant();
        //
        $this->registerBindingClasses();
    }

    /**
     * 绑定对象
     */
    protected function registerBindingClasses ()
    {
        $this->app->singleton( 'aliyun.openapi', function () {
            return new LaravelAliyunManager();
        } );
        $this->app->singleton( 'aliyun.openapi.vod', function () {
            return new LaravelAliyunVodManager();
        } );
    }

    /**
     * 发布配置文件
     */
    protected function publishConfig ()
    {
        $this->publishes( [
            __DIR__ . '/../config/aliopen.php'  =>  config_path( 'aliopen.php' )
        ], 'config' );
    }

    /**
     * 获取需要加载的目录列表
     * @return \Illuminate\Config\Repository|mixed
     */
    protected function setAliyunAutoload()
    {
        return config('aliopen.autoload');
    }

    /**
     * aliyun 包路径
     * @return string
     */
    protected function setAliyunPath()
    {
        return base_path('vendor/mrlaozhou/aliyun-sdk');
    }
}
