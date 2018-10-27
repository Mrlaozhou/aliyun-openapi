<?php

namespace Mrlaozhou\Aliyun\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Aliyun
 * @method static client($accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
 * @package Mrlaozhou\Aliyun\Facades
 */
class Aliyun extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'aliyun.openapi';
    }
}