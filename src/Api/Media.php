<?php


namespace Clover\WechatOA\Api;


/**
 * Class Media
 */
class Media
{
    private $accessToken;
    private $voiceUrl = 'https://api.weixin.qq.com/cgi-bin/media/get/jssdk?access_token=%s&media_id=%s';
    private $getUrl = 'https://api.weixin.qq.com/cgi-bin/media/get?access_token=%s&media_id=%s';
    private $addUrl = 'https://api.weixin.qq.com/cgi-bin/media/upload?access_token=%s';

    /**
     * Media constructor.
     * @param string $accessToken
     */
    final public function __construct(&$accessToken)
    {
        $this->accessToken = &$accessToken;
    }

    /**
     * @param $file
     * @return array|bool
     */
    public function addImage($file)
    {
        return $this->upload($file, 'image');
    }

    /**
     * @param $file
     * @return array|bool
     */
    public function addThumb($file)
    {
        return $this->upload($file, 'thumb');
    }

    /**
     * @param $file
     * @return array|bool
     */
    public function addVoice($file)
    {
        return $this->upload($file, 'voice');
    }


    /**
     * @param $file
     * @return array|bool
     */
    public function addViceo($file)
    {
        return $this->upload($file, 'video');
    }

    /**
     * 新增临时素材
     * @param array $file
     * @param string $type image/video/voice/thumb
     * @return array|bool
     */
    public function upload($file, $type = '')
    {
        $url = sprintf($this->addUrl, $this->accessToken);
        if ($result = wechat_upload_file($url, $file, $type))
            return $result;
        return false;
    }

    /**
     * 下载临时素材
     * @param string $mediaId
     * @param string $file
     * @return string|bool
     */
    public function download($mediaId, $file)
    {
        $url = sprintf($this->getUrl, $this->accessToken, $mediaId);
        if ($result = wechat_download_file($url, $file))
            return $result;
        return false;
    }

    /**
     * 下载网页上传的语音
     * @param string $mediaId
     * @param string $file
     * @return string|bool
     */
    public function downloadVoice($mediaId, $file)
    {
        $url = sprintf($this->voiceUrl, $this->accessToken, $mediaId);
        if ($result = wechat_download_file($url, $file))
            return $result;
        return false;
    }
}