<?php
use axonivy\update\model\Network;
use PHPUnit\Framework\TestCase;

final class NetworkTest extends TestCase
{

    public function testGetter()
    {
        $network = new Network('55:66', '192.168.0.1', 'localhost');
        $this->assertEquals('55:66', $network->getHardwareAddress());
        $this->assertEquals('192.168.0.1', $network->getIpAddress());
        $this->assertEquals('localhost', $network->getNetworkHostName());
    }
}
