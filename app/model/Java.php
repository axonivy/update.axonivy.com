<?php
namespace model;

class Java {
	private $vendor;
	private $version;
	private $vmName;
	private $vmVendor;
	private $vmVersion;

	public function __construct($vendor, $version, $vmName, $vmVendor, $vmVersion) {
		$this->vendor = $vendor;
		$this->version = $version;
		$this->vmName = $vmName;
		$this->vmVendor = $vmVendor;
		$this->vmVersion = $vmVersion;
	}
	
	public function getVendor() {
		return $this->vendor;
	}
	public function getVersion() {
		return $this->version;
	}
	public function getVmName() {
		return $this->vmName;
	}
	public function getVmVendor() {
		return $this->vmVendor;
	}
	public function getVmVersion() {
		return $this->vmVersion;
	}
}