<?php

declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: 狂奔的螞蟻 <www.firstphp.com>
 * Date: 2019/9/10
 * Time: 下午16:20
 */

namespace Firstphp\FirstphpWxapp;


use Firstphp\FirstphpWxapp\Bridge\Http;

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



    public function __construct(array $config)
    {
        $this->config = $config ? $config : config("wxapp");
        $this->appId = $this->config['appid'];
        $this->appSecret = $this->config['appsecret'];
        $this->appKey = $this->config['wxapp_key'];
        $this->http = new Http();
    }


    /**
     * @param string $code
     * @return mixed
     */
    public function login(string $code)
    {
        return $this->http->post('sns/jscode2session', [
            'form_params' => [
                'appid' => $this->appId,
                'secret' => $this->appSecret,
                'js_code' => $code,
                'grant_type' => 'authorization_code'
            ]
        ]);
    }


    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->http->post('cgi-bin/token', [
            'form_params' => [
                'appid' => $this->appId,
                'secret' => $this->appSecret,
                'grant_type' => 'client_credential'
            ]
        ]);
    }


    /**
     * @param string $path
     * @param string $accessToken
     * @param int $width
     * @return array
     */
    public function getQrcode(string $path = '/', string $accessToken = '', int $width = 430) {
        $params = [
            'path' => $path,
            'width' => $width,
        ];
        $res = $this->httpPostJson('https://api.weixin.qq.com/wxa/getwxacode?access_token='.$accessToken, json_encode($params));
        $decodeRes = json_decode($res[1], true);
        if (isset($decodeRes['errcode'])) {
            return ['code' => $decodeRes['errcode'], 'msg' =>$decodeRes['errmsg']];
        } else {
            return ['code' => 200, 'data' => $res[1]];
        }
    }


    /**
     * @param string $path
     * @param string $accessToken
     * @return array
     */
    public function getWxacode(string $path = '/', string $accessToken = '') {
        $params = [
            'scene' => 'id=1',
            'path' => $path,
            'width' => 430,
        ];
        $res = $this->httpPostJson('https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token='.$accessToken, json_encode($params));
        $decodeRes = json_decode($res[1], true);
        if (isset($decodeRes['errcode'])) {
            return ['code' => $decodeRes['errcode'], 'msg' =>$decodeRes['errmsg']];
        } else {
            return ['code' => 200, 'data' => $res[1]];
        }
    }



    /**
     * @param array $params
     * @param string $accessToken
     */
    public function sendTemplateMessage(array $params, string $accessToken)
    {
        $res = $this->httpPostJson('https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send?access_token='.$accessToken, json_encode($params));
        $decodeRes = json_decode($res[1], true);
        if (isset($decodeRes['errcode'])) {
            return ['code' => $decodeRes['errcode'], 'msg' =>$decodeRes['errmsg']];
        } else {
            return ['code' => 200, 'data' => $res[1]];
        }
    }



    /**
     * 发送POST请求
     */
    public function httpPostJson($url, $jsonStr) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8',
                'Content-Length: ' . strlen($jsonStr)
            )
        );
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        return array($httpCode, $response);
    }

}