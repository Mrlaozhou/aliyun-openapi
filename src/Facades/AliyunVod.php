<?php

namespace Mrlaozhou\Aliyun\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class AliyunVod
 *
 * 视频播放
 * @method static playInfo ($videoId, $expire=3600*24, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
 * @method static createPlayAuth ($videoId,$expire=3600, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
 *
 * 视频上传
 * @method static createUploadAuth (array $videoInfo,$accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
 * @method static refreshUploadAuth (string $videoId, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai' )
 * @method static createImageUploadAuth ($imageType, $imageExt, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai' )
 *
 * 视频管理
 * @method static videoInfo ( $videoId, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai' )
 * @method static updateVideoInfo($videoId,array $videoInfo, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
 * @method static deleteVideos ($videoIds, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
 * @method static videosList (array $wheres,$accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
 * @method static deleteStream ($videoId, $jobIds, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai' )
 * @method static mezzanineInfo ($videoId, $expire=3600*5, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
 *
 * 分类管理
 * @method static createCategory (array $attributes,$accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
 * @method static updateCategory (array $attribute, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
 * @method static deleteCategory (int $cateId, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
 * @method static getCategories (array $wheres, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai' )
 *
 * @package Mrlaozhou\Aliyun\Facades
 */
class AliyunVod extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'aliyun.openapi.vod';
    }
}