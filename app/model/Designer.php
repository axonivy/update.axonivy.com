<?php
namespace model;

class Designer {
	
	private $version;
	
	public function __construct($version) {
		$this->version = $version;
	}
	
	public function getVersion() {
		return $this->version;
	}
}
