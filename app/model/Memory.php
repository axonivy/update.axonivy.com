<?php
namespace model;

class Memory {
	
	private $maxHeapMemory;
	private $maxNonHeapMemory;
	
	public function __construct($maxHeapMemory, $maxNonHeapMemory) {
		$this->maxHeapMemory = intval($maxHeapMemory);
		$this->maxNonHeapMemory = intval($maxNonHeapMemory);
	}
	
	public function getMaxHeapMemory() {
		return $this->maxHeapMemory;
	}
	
	public function getMaxNonHeapMemory() {
		return $this->maxNonHeapMemory;
	}
	
}
