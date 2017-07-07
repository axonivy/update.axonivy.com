<?php
namespace axonivy\update\model;

class HttpRequest
{
    private $ipAddress;
    
    public function __construct($ipAddress)
    {
        if (empty($ipAddress)) {
            $ipAddress = '';    
        }
        $this->ipAddress = $ipAddress;
    }
    
    public function getIpAddress(): string
    {
        return $this->ipAddress;
    }
}