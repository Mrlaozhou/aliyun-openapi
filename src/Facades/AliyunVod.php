<?php

namespace Mrlaozhou\Aliyun\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class AliyunVod
 *
 * @method static client($accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
 * @method static videoInfo($videoId,$accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
 * @method static createUploadAuth (array $videoInfo,$accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
 * @method static refreshUploadAuth (string $videoId, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai' )
 * @method static createImageUploadAuth ($imageType, $imageExt, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai' )
 * @package Mrlaozhou\Aliyun\Facades
 */
class AliyunVod extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'aliyun.openapi';
    }
}