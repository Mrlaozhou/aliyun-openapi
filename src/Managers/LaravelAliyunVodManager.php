<?php

namespace Mrlaozhou\Aliyun\Managers;

use Illuminate\Support\Arr;
use Mrlaozhou\Aliyun\Exception\AliyunException;
use \Vod\Request\V20170321 as vod;

class LaravelAliyunVodManager extends LaravelAliyunManager
{
    /*
    |--------------------------------------------------------------------------
    | 视频管理
    |--------------------------------------------------------------------------
    */
    /**
     * @param        $videoId
     * @param string $accessKeyId
     * @param string $accessKeySecret
     * @param string $regionId
     *
     * @return mixed|\SimpleXMLElement|string
     */
    public function videoInfo ( $videoId, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai' )
    {
        //  获取客户端
        $client             =   $this->client( $accessKeyId, $accessKeySecret, $regionId );
        $request = new vod\GetVideoInfoRequest();
        $request->setVideoId($videoId);
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }

    /**
     * @param        $videoId
     * @param array  $videoInfo
     * @param string $accessKeyId
     * @param string $accessKeySecret
     * @param string $regionId
     *
     * @return mixed|\SimpleXMLElement|string
     */
    public function updateVideoInfo($videoId,array $videoInfo, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
    {
        //  获取客户端
        $client             =   $this->client( $accessKeyId, $accessKeySecret, $regionId );
        $request = new vod\UpdateVideoInfoRequest();
        $request->setVideoId($videoId);
        //  更改视频标题
        $request->setTitle( Arr::get($videoInfo, 'title', '') );
        //  更改视频描述
        $request->setDescription( Arr::get($videoInfo, 'desc', '') );
        // 更改视频封面
        $request->setCoverURL( Arr::get($videoInfo, 'cover', '') );
        // 更改视频标签，多个用逗号分隔
        $request->setTags( Arr::get($videoInfo, 'tags', '') );
        // 更改视频分类(可在点播控制台·全局设置·分类管理里查看分类ID：https://vod.console.aliyun.com/#/vod/settings/category)
        $request->setCateId( Arr::get($videoInfo, 'cateId', 0) );
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }

    /**
     * @param static|array       $videoIds
     * @param string $accessKeyId
     * @param string $accessKeySecret
     * @param string $regionId
     *
     * @return mixed|\SimpleXMLElement|string
     */
    public function deleteVideos ($videoIds, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
    {
        //  获取客户端
        $client             =   $this->client( $accessKeyId, $accessKeySecret, $regionId );
        $request = new vod\DeleteVideoRequest();
        // 支持批量删除视频；videoIds为传入的视频ID列表，多个用逗号分隔
        $request->setVideoIds($videoIds);
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }

    /**
     * @param array  $wheres
     * @param string $accessKeyId
     * @param string $accessKeySecret
     * @param string $regionId
     *
     * @return mixed|\SimpleXMLElement|string
     */
    public function videosList (array $wheres,$accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
    {
        //  获取客户端
        $client             =   $this->client( $accessKeyId, $accessKeySecret, $regionId );
        $request = new vod\GetVideoListRequest();
        date_default_timezone_set('UTC');
        date_default_timezone_set( date_default_timezone_get() );
        // 视频创建的起始时间，为UTC格式
        $request->setStartTime(gmdate('Y-m-d\TH:i:s\Z', Arr::get( $wheres, 'startTime', time()-24*60*60 )));
        // 视频创建的结束时间，为UTC格式
        $request->setEndTime(gmdate('Y-m-d\TH:i:s\Z', time()));
        // 视频状态，默认获取所有状态的视频，多个用逗号分隔
        $request->setStatus(Arr::get($wheres, 'status', 'Uploading,Normal,Transcoding'));
        // 按分类进行筛选
        $request->setCateId(Arr::get($wheres, 'cateId', 0));
        $request->setPageNo(Arr::get($wheres, 'page', 1));
        $request->setPageSize(Arr::get($wheres, 'pageSize', 10));
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }

    /**
     * @param        $videoId
     * @param        $jobIds
     * @param string $accessKeyId
     * @param string $accessKeySecret
     * @param string $regionId
     *
     * @return mixed|\SimpleXMLElement|string
     */
    public function deleteStream ($videoId, $jobIds, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai' )
    {
        //  获取客户端
        $client             =   $this->client( $accessKeyId, $accessKeySecret, $regionId );
        $request = new vod\DeleteStreamRequest();
        $request->setVideoId($videoId);
        $request->setJobIds($jobIds);   // 媒体流转码的作业ID列表，多个用逗号分隔；JobId可通过获取播放地址接口(GetPlayInfo)获取到。
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }

    /**
     * @param           $videoId
     * @param float|int $expire
     * @param string    $accessKeyId
     * @param string    $accessKeySecret
     * @param string    $regionId
     *
     * @return mixed|\SimpleXMLElement|string
     */
    public function mezzanineInfo ($videoId, $expire=3600*5, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
    {
        //  获取客户端
        $client             =   $this->client( $accessKeyId, $accessKeySecret, $regionId );
        $request = new vod\GetMezzanineInfoRequest();
        $request->setVideoId($videoId);
        // 原片下载地址过期时间，单位：秒，默认为3600秒
        $request->setAuthTimeout($expire);
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }

    /*
    |--------------------------------------------------------------------------
    | 视频播放
    |--------------------------------------------------------------------------
    */

    /**
     * @param           $videoId
     * @param float|int $expire
     * @param string    $accessKeyId
     * @param string    $accessKeySecret
     * @param string    $regionId
     *
     * @return mixed|\SimpleXMLElement|string
     */
    public function playInfo ($videoId, $expire=3600*24, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
    {
        //  获取客户端
        $client             =   $this->client( $accessKeyId, $accessKeySecret, $regionId );
        $request = new vod\GetPlayInfoRequest();
        $request->setVideoId($videoId);
        $request->setAuthTimeout($expire);
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }

    /**
     * @param        $videoId
     * @param int    $expire
     * @param string $accessKeyId
     * @param string $accessKeySecret
     * @param string $regionId
     *
     * @return mixed|\SimpleXMLElement|string
     */
    public function createPlayAuth ($videoId,$expire=3600, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
    {
        //  获取客户端
        $client             =   $this->client( $accessKeyId, $accessKeySecret, $regionId );
        $request = new vod\GetVideoPlayAuthRequest();
        $request->setVideoId($videoId);
        //  播放凭证过期时间，默认为100秒，取值范围100~3600；
        //  注意：播放凭证用来传给播放器自动换取播放地址，凭证过期时间不是播放地址的过期时间
        $request->setAuthInfoTimeout($expire);
        $request->setAcceptFormat('JSON');
        $response = $client->getAcsResponse($request);
        return $response;
    }

    /*
    |--------------------------------------------------------------------------
    | 视频上传
    |--------------------------------------------------------------------------
    */

    /**
     * @param array $videoInfo [
     *                         'title' => '',
     *                         'filename' => ''
     *                         'desc' => '',
     *                         'cover' => '',
     *                         'tags' => '',
     *                         'format' => ''
     *                         ]
     * @param string $accessKeyId
     * @param string $accessKeySecret
     * @param string $regionId
     *
     * @return mixed|\SimpleXMLElement
     */
    public function createUploadAuth (array $videoInfo,$accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
    {
        //  获取客户端
        $client             =   $this->client( $accessKeyId, $accessKeySecret, $regionId );
        $request = new vod\CreateUploadVideoRequest();
        // 视频标题(必填参数)
        $request->setTitle( Arr::get($videoInfo, 'title', '') );
        // 视频源文件名称，必须包含扩展名(必填参数)
        $request->setFileName( Arr::get($videoInfo, 'filename', '') );
        // 视频源文件描述(可选)
        $request->setDescription( Arr::get( $videoInfo, 'desc', '' ) );
        // 自定义视频封面(可选)
        $request->setCoverURL( Arr::get($videoInfo, 'cover', '') );
        // 视频标签，多个用逗号分隔(可选)
        $request->setTags( Arr::get($videoInfo, 'tags', '') );
        $request->setAcceptFormat( Arr::get($videoInfo, 'format', 'JSON') );

        return $client->getAcsResponse($request);
    }

    /**
     * @param string $videoId
     * @param string $accessKeyId
     * @param string $accessKeySecret
     * @param string $regionId
     *
     * @return mixed|\SimpleXMLElement
     * @throws \Mrlaozhou\Aliyun\Exception\AliyunException
     */
    public function refreshUploadAuth (string $videoId, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai' )
    {
        if( ! $videoId ) {
            throw new AliyunException( '视频ID不合法.' );
        }
        //  获取客户端
        $client             =   $this->client( $accessKeyId, $accessKeySecret, $regionId );
        $request = new vod\RefreshUploadVideoRequest();
        $request->setVideoId($videoId);
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }

    /**
     * @param        $imageType
     * @param        $imageExt
     * @param string $accessKeyId
     * @param string $accessKeySecret
     * @param string $regionId
     *
     * @return mixed|\SimpleXMLElement
     */
    public function createImageUploadAuth ($imageType, $imageExt, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai' )
    {
        //  获取客户端
        $client             =   $this->client( $accessKeyId, $accessKeySecret, $regionId );
        $request = new vod\CreateUploadImageRequest();
        $request->setImageType($imageType);
        $request->setImageExt($imageExt);
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }

    /*
    |--------------------------------------------------------------------------
    | 视频分类管理
    |--------------------------------------------------------------------------
    */

    /**
     * @param array  $attributes
     * @param string $accessKeyId
     * @param string $accessKeySecret
     * @param string $regionId
     *
     * @return mixed|\SimpleXMLElement|string
     */
    public function createCategory (array $attributes,$accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
    {
        //  获取客户端
        $client             =   $this->client( $accessKeyId, $accessKeySecret, $regionId );
        $request = new vod\AddCategoryRequest();
        // 分类名称，不能超过64个字节，UTF8编码
        $request->setCateName( Arr::get($attributes, 'cateName') );
        // 父分类ID，若不填，则默认生成一级分类，根节点分类ID为-1
        $request->setParentId( Arr::get($attributes, 'parentId') );
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }

    /**
     * @param array  $attribute
     * @param string $accessKeyId
     * @param string $accessKeySecret
     * @param string $regionId
     *
     * @return mixed|\SimpleXMLElement|string
     */
    public function updateCategory (array $attribute, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
    {
        //  获取客户端
        $client             =   $this->client( $accessKeyId, $accessKeySecret, $regionId );
        $request = new vod\UpdateCategoryRequest();
        $request->setCateId( Arr::get($attribute, 'cateId') );
        // 分类名称，不能超过64个字节，UTF8编码
        $request->setCateName( Arr::get($attribute, 'cateName') );
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }

    /**
     * @param int    $cateId
     * @param string $accessKeyId
     * @param string $accessKeySecret
     * @param string $regionId
     *
     * @return mixed|\SimpleXMLElement|string
     */
    public function deleteCategory (int $cateId, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
    {
        //  获取客户端
        $client             =   $this->client( $accessKeyId, $accessKeySecret, $regionId );
        $request = new vod\DeleteCategoryRequest();
        $request->setCateId($cateId);
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }

    /**
     * @param array  $wheres
     * @param string $accessKeyId
     * @param string $accessKeySecret
     * @param string $regionId
     *
     * @return mixed|\SimpleXMLElement|string
     */
    public function getCategories (array $wheres, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai' )
    {
        //  获取客户端
        $client             =   $this->client( $accessKeyId, $accessKeySecret, $regionId );
        $request = new vod\GetCategoriesRequest();
        // 分类ID，默认为根节点分类ID即-1
        $request->setCateId( Arr::get($wheres, 'cateId') );
        $request->setPageNo( Arr::get($wheres, 'page', 1) );
        $request->setPageSize( Arr::get($wheres, 'pageSize', 10) );
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }
}