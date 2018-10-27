<?php

namespace Mrlaozhou\Aliyun\Managers;

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
}