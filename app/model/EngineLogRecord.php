<?php
namespace model;

use model\Java;
use model\Licence;
use model\Memory;
use model\Network;
use model\OperatingSystem;
use model\Engine;
use model\SystemDatabase;

class EngineLogRecord {
	
	private $id;
	private $timestamp;
	private $java;
	private $licence;
	private $memory;
	private $network;
	private $operatingSystem;
	private $engine;
	private $systemDatabase;
	
	
	public function __construct(
		$timestamp,
		Java $java,
		Licence $licence,
		Memory $memory,
		Network $network,
		OperatingSystem $operatingSystem,
		Engine $engine,
		SystemDatabase $systemDatabase) {

		$this->timestamp = $timestamp;
		$this->java = $java;
		$this->licence = $licence;
		$this->memory = $memory;
		$this->network = $network;
		$this->operatingSystem = $operatingSystem;
		$this->engine = $engine;
		$this->systemDatabase = $systemDatabase;
	}
	
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}
	public function getTimestamp() {
		return $this->timestamp;
	}
	public function getJava() {
		return $this->java;
	}
	public function getLicence() {
		return $this->licence;
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
	public function getEngine() {
		return $this->engine;
	}
	public function getSystemDatabase() {
		return $this->systemDatabase;
	}
}
