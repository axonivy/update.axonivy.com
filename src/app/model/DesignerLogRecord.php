<?php
namespace axonivy\update\model;

class DesignerLogRecord
{

    private $timestamp;
    
    private $httpRequest;

    private $java;

    private $designer;

    private $memory;

    private $network;

    private $operatingSystem;

    public function __construct($timestamp, HttpRequest $httpRequest, Java $java, Designer $designer, Memory $memory, Network $network, OperatingSystem $operatingSystem)
    {
        $this->timestamp = $timestamp;
        $this->httpRequest = $httpRequest;
        $this->java = $java;
        $this->designer = $designer;
        $this->memory = $memory;
        $this->network = $network;
        $this->operatingSystem = $operatingSystem;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getHttpRequest(): HttpRequest
    {
        return $this->httpRequest;
    }
    
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function getJava()
    {
        return $this->java;
    }

    public function getDesigner()
    {
        return $this->designer;
    }

    public function getMemory()
    {
        return $this->memory;
    }

    public function getNetwork()
    {
        return $this->network;
	}
	public function getOperatingSystem() {
		return $this->operatingSystem;
	}
}