<?php
/**
 * Created by PhpStorm.
 * User: 狂奔的螞蟻 <www.firstphp.com>
 * Date: 2019/9/10
 * Time: 下午16:20
 */

namespace Hyperf\FirstphpWxapp;


class WxappServer implements WxappInterface
{

    const OK = 0;
    const ILLEGAL_AES_KEY = -40001;
    const ILLEGAL_IV = -40002;
    const ILLEGAL_BUFFER = -40003;
    const DECODE_BASE64_ERROR = -40004;

    protected $appId;
    protected $appSecret;
    protected $appKey;
    protected $config;
    protected $http;


    public function __construct($config)
    {
        $this->config = config("wxapp");
        $this->appId = $this->config['appid'];
        $this->appSecret = $this->config['appsecret'];
        $this->appKey = $this->config['wxapp_key'];
    }


    /**
     * @param string $code
     */
    public function authLogin(string $code)
    {
        var_dump(11111);
    }


    /**
     *
     */
    public function getAccessToken()
    {
        var_dump(22222);
    }


    /**
     * @param array $params
     * @param string $accessToken
     */
    public function sendTemplateMessage(array $params, string $accessToken)
    {
        var_dump(33333);
    }


}