<?php
/**
 * Author: 狂奔的螞蟻 <www.firstphp.com>
 * Date: 2019/9/11
 * Time: 6:03 PM
 */

namespace Firstphp\FirstphpWxapp\Bridge;

use Hyperf\Guzzle\ClientFactory;

class Foo
{
    /**
     * @var \Hyperf\Guzzle\ClientFactory
     */
    private $clientFactory;

    public function __construct(ClientFactory $clientFactory)
    {
        $this->clientFactory = $clientFactory;
    }

    public function bar($options = [])
    {
        $client = $this->clientFactory->create($options);
        return $client;
    }
}