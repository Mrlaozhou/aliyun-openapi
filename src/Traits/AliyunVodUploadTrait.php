<?php
namespace Mrlaozhou\Aliyun\Traits;

use Illuminate\Http\File;
use Mrlaozhou\Aliyun\Uploader\AliyunVodUploader;
use Mrlaozhou\Aliyun\Uploader\UploadVideoRequest;
use Symfony\Component\Finder\SplFileInfo;

trait AliyunVodUploadTrait
{

    /**
     * @param string $file
     * @param string $title
     * @param string $data
     *
     * @return string
     * @throws \Exception
     */
    public function vodLocalUpload(string $file, string $title = '', $data = '')
    {
        return $this->getUploader()->uploadLocalVideo(
            $this->prepareAliyunVodRequest($file, $title, $data)
        );
    }

    /**
     * @param string $url
     * @param        $title
     * @param array  $data
     *
     * @return string
     * @throws \Exception
     */
    public function vodWebUpload(string $url, string $title = '', $data = '')
    {
        return $this->getUploader()->uploadWebVideo(
            $this->prepareAliyunVodRequest($url, $title, $data)
        );
    }

    /**
     * @param       $filename
     * @param null  $title
     * @param  $data
     *
     * @return \Mrlaozhou\Aliyun\Uploader\UploadVideoRequest
     * @throws \Exception
     */
    protected function prepareAliyunVodRequest($filename, string $title, $data = null)
    {
        $uploadVideoRequest =   new UploadVideoRequest($this->getFilename($filename), $title ?: '' );
        $data && $uploadVideoRequest->setUserData($data);
        return $uploadVideoRequest;
    }

    /**
     * @return \Mrlaozhou\Aliyun\Uploader\AliyunVodUploader
     */
    protected function getUploader()
    {
        return new AliyunVodUploader(config('aliopen.accessKeyId'), config('aliopen.accessKeySecret'));
    }

    protected function getFilename($file)
    {
        if( is_string($file) ) {
            return $file;
        }
        if( $file instanceof SplFileInfo ) {
            return $file->getFilename();
        }
        return $file;
    }
}
