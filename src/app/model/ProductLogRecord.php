<?php
namespace axonivy\update\model;

class ProductLogRecord
{
    private int $timestamp;
    private string $ipAddress;
    private string $product;
    private string $version;
    private string $usage;

    public function __construct(int $timestamp, string $ipAddress, string $product, string $version, string $usage)
    {
        $this->timestamp = $timestamp;
        $this->ipAddress = $ipAddress;
        $this->product = $product;
        $this->version = $version;
        $this->usage = $usage;
    }
    
    public function getIpAddress(): string
    {
        return $this->ipAddress;
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public function getProduct(): string
    {
        return $this->product;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function getUsage(): string
    {
        return $this->usage;
    }

}
