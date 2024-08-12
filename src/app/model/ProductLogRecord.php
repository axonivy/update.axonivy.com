<?php
namespace axonivy\update\model;

class ProductLogRecord
{
    private $id;
    private $timestamp;
    private $ipAddress;
    private $product;
    private $version;
    private $usage;

    public function __construct($timestamp, string $ipAddress, string $product, string $version, string $usage)
    {
        $this->timestamp = $timestamp;
        $this->ipAddress = $ipAddress;
        $this->product = $product;
        $this->version = $version;
        $this->usage = $usage;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function getUsage()
    {
        return $this->usage;
    }

}
