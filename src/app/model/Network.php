<?php
namespace axonivy\update\model;

class Network
{

    private $hardwareAddress;

    private $hostName;

    private $ipAddress;

    public function __construct($hardwareAddress, $ipAddress, $hostName)
    {
        $this->hardwareAddress = $hardwareAddress;
        $this->ipAddress = $ipAddress;
        $this->hostName = $hostName;
    }

    public function getHardwareAddress()
    {
        return $this->hardwareAddress;
    }

    public function getNetworkHostName()
    {
        return $this->hostName;
    }

    public function getIpAddress()
    {
        return $this->ipAddress;
    }
}