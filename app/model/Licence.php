<?php
namespace model;

class Licence {
	private $id;
	private $individual;
	private $organisation;
	
	public function __construct($id, $individual, $organisation) {
		$this->id = $id;
		$this->individual = $individual;
		$this->organisation = $organisation;
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function getIndividual() {
		return $this->individual;
	}
	
	public function getOrganisation() {
		return $this->organisation;
	}
}
