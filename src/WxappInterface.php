<?php

declare(strict_types=1);

/**
 * Author: 狂奔的螞蟻 <www.firstphp.com>
 * Date: 2019/9/11
 * Time: 11:59 AM
 */

namespace Hyperf\FirstphpWxapp;


interface WxappInterface
{

    /**
     * @param string $code
     * @return mixed
     */
    public function authLogin(string $code);


    /**
     * @return mixed
     */
    public function getAccessToken();


    /**
     * @param string $params
     * @param array $accessToken
     * @return mixed
     */
    public function sendTemplateMessage(array $params, string $accessToken);


}