<?php

declare(strict_types=1);

namespace Hyperf\FirstphpWxapp;


use Hyperf\Contract\ConfigInterface;
use Psr\Container\ContainerInterface;


class WxappFactory
{

    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get(ConfigInterface::class);
        return make(WxappServer::class, $config->get('wxapp'));
    }

}

