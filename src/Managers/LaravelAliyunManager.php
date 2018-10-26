<?php

namespace Mrlaozhou\Aliyun\Managers;

use Illuminate\Support\Arr;
use Mrlaozhou\Aliyun\Exception\AliyunException;
use \vod\Request\V20170321 as vod;
class LaravelAliyunManager
{

    /**
     * @param string $accessKeyId
     * @param string $accessKeySecret
     * @param string $regionId
     *
     * @return \DefaultAcsClient
     */
    public function client ($accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
    {
        return new \DefaultAcsClient(
            \DefaultProfile::getProfile(
                $regionId,
                $accessKeyId ?: config('aliopen.accessKeyId'),
                $accessKeySecret ?: config('aliopen.accessKeySecret')
            )
        );
    }

    /**
     * @param        $videoId
     * @param string $accessKeyId
     * @param string $accessKeySecret
     * @param string $regionId
     *
     * @return mixed|\SimpleXMLElement
     */
    public function videoInfo ($videoId, $accessKeyId='', $accessKeySecret='',$regionId='cn-shanghai')
    {
        //  获取客户端
        $client             =   $this->client( $accessKeyId, $accessKeySecret, $regionId );
        $request = new vod\GetPlayInfoRequest();
        $request->setVideoId($videoId);
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }

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

}