<?php
namespace model;

class OperatingSystem {
	
	private $architecture;
	private $name;
	private $version;	
	private $availableProcessors;
	
	public function __construct($architecture, $name, $version, $availableProcessors) {
		$this->architecture = $architecture;
		$this->name = $name;
		$this->version = $version;
		$this->availableProcessors = intval($availableProcessors);
	}
	
	public function getArchitecture() {
		return $this->architecture;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function getVersion() {
		return $this->version;
	}
	
	public function getAvailableProcessors() {
		return $this->availableProcessors;
	}
}