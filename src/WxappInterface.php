<?php

declare(strict_types=1);

/**
 * Author: 狂奔的螞蟻 <www.firstphp.com>
 * Date: 2019/9/11
 * Time: 11:59 AM
 */

namespace Firstphp\FirstphpWxapp;


interface WxappInterface
{

    /**
     * 微信登录
     *
     * @param string $code
     * @return mixed
     */
    public function login(string $code);


    /**
     * 获取access_token
     *
     * @return mixed
     */
    public function getAccessToken();


    /**
     * 发送模板消息
     *
     * @param string $params
     * @param array $accessToken
     * @return mixed
     */
    public function sendTemplateMessage(array $params, string $accessToken);


    /**
     * 生成小程序二维码
     *
     * @param string $path
     * @param string $accessToken
     * @param int $width
     * @return mixed
     */
    public function getQrcode(string $path = '/', string $accessToken = '', int $width = 430);


    /**
     * 生成小程序二维码
     *
     * @param string $path
     * @param string $accessToken
     * @return mixed
     */
    public function getWxacode(string $path = '/', string $accessToken = '');


}