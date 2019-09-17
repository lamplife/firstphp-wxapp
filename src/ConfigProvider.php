<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace Firstphp\FirstphpWxapp;


class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                \Firstphp\FirstphpWxapp\WxappInterface::class => \Firstphp\FirstphpWxapp\Facades\WxappFactory::class
            ],
            'commands' => [
            ],  
            'scan' => [
                'paths' => [
                    __DIR__,
                ],
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config for firstphp-wxapp.',
                    'source' => __DIR__ . '/../publish/wxapp.php',
                    'destination' => BASE_PATH . '/config/autoload/wxapp.php',
                ],
            ],
        ];
    }
}
