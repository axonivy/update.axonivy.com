<?php
use PHPUnit\Framework\TestCase;
use axonivy\update\model\HttpRequest;

final class HttpRequestTest extends TestCase
{

    public function testIpAddress()
    {
        $request = new HttpRequest('245.57.46.99');
        $this->assertEquals('245.57.46.99', $request->getIpAddress());
        
        $request = new HttpRequest('');
        $this->assertEquals('', $request->getIpAddress());
        
        $request = new HttpRequest(null);
        $this->assertEquals('', $request->getIpAddress());
        
        $request = new HttpRequest('ABCD:ABCD:ABCD:ABCD:ABCD:ABCD:ABCD:ABCD');
        $this->assertEquals('ABCD:ABCD:ABCD:ABCD:ABCD:ABCD:ABCD:ABCD', $request->getIpAddress());
    }
}
