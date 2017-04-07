<?php
namespace model;

class SystemDatabase {

	private $id;
	private $driver;
	private $produtName;
	private $productVersion;
	
	public function __construct($id, $driver, $produtName, $productVersion) {
		$this->id = intval($id);
		$this->driver = $driver;
		$this->produtName = $produtName;
		$this->productVersion = $productVersion;
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function getDriver() {
		return $this->driver;
	}
	
	public function getProductName() {
		return $this->produtName;
	}
	
	public function getProductVersion() {
		return $this->productVersion;
	}
}
