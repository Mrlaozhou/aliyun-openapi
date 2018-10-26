<?php

namespace Mrlaozhou\Aliyun;

use Mrlaozhou\Aliyun\Managers\LaravelAliyunManager;

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
        //
        $this->includeAliyunFiles();
        //
        $this->registerAutoload();
        //
        $this->registerConstant();
        //
        $this->app->singleton( 'aliyun.openapi', function () {
            return new LaravelAliyunManager();
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
    protected function getAutoload()
    {
        // TODO: Implement getAutoload() method.
        return config('aliopen.autoload');
    }
}