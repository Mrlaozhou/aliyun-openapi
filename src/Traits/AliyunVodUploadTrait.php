<?php
namespace Mrlaozhou\Aliyun\Traits;

use Mrlaozhou\Aliyun\Uploader\AliyunVodUploader;
use Mrlaozhou\Aliyun\Uploader\UploadVideoRequest;
use Symfony\Component\Finder\SplFileInfo;

trait AliyunVodUploadTrait
{

    /**
     * @param string|SplFileInfo     $file
     * @param array|null $data
     * @throws \Exception
     * @return string
     */
    public function vodUpload(string $file, array $data = [])
    {
        $userData       =   [
            'MessageCallback'   =>  ["CallbackURL"=>"https://demo.sample.com/ProcessMessageCallback"],
            'Extend'            =>  ["localId"=>"xxx", "test"=>"www"]
        ];
        $userData       =   array_merge($userData, $data);
        $uploader       =   new AliyunVodUploader(config('aliopen.accessKeyId'), config('aliopen.accessKeySecret'));
        $uploadVideoRequest     =   new UploadVideoRequest($this->getFilename($file), 'testUploadLocalVideo via PHP-SDK');
        $uploadVideoRequest->setUserData(json_encode($userData));
        return $uploader->uploadLocalVideo($uploadVideoRequest);
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
