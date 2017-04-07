<?php
namespace model;

use model\Java;
use model\Designer;
use model\Memory;
use model\Network;
use model\OperatingSystem;

class DesignerLogRecord {
	
	private $timestamp;
	private $java;
	private $designer;
	private $memory;
	private $network;
	private $operatingSystem;
	
	public function __construct(
		$timestamp,
		Java $java,
		Designer $designer,
		Memory $memory,
		Network $network,
		OperatingSystem $operatingSystem) {
	
		$this->timestamp = $timestamp;
		$this->java = $java;
		$this->designer = $designer;
		$this->memory = $memory;
		$this->network = $network;
		$this->operatingSystem = $operatingSystem;
	}
	
	public function getTimestamp() {
		return $this->timestamp;
	}
	public function getJava() {
		return $this->java;
	}
	public function getDesigner() {
		return $this->designer;
	}
	public function getMemory() {
		return $this->memory;
	}
	public function getNetwork() {
		return $this->network;
	}
	public function getOperatingSystem() {
		return $this->operatingSystem;
	}
}