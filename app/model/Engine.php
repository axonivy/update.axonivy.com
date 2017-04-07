<?php
namespace model;

class Engine {
	
	private $applications;
	private $clusterNodesConfigured;
	private $clusterNodesRunning;
	private $licensedUsers;
	private $processModelVersions;
	private $processModelVersionsDeleted;
	private $processModels;
	private $runningCases;
	private $runningTasks;
	private $upTime;
	private $users;
	private $version;
	
	public function __construct(
		$applications,
		$clusterNodesConfigured, 
		$clusterNodesRunning, 
		$licensedUsers,
		$processModelVersions,
		$processModelVersionsDeleted,
		$processModels,
		$runningCases,
		$runningTasks,
		$upTime,
		$users,
		$version) {
		
		$this->applications = intval($applications);
		$this->clusterNodesConfigured = intval($clusterNodesConfigured);
		$this->clusterNodesRunning = intval($clusterNodesRunning);
		$this->licensedUsers = intval($licensedUsers);
		
		$this->processModelVersions = intval($processModelVersions);
		$this->processModelVersionsDeleted = intval($processModelVersionsDeleted);
		$this->processModels = intval($processModels);
		$this->runningCases = intval($runningCases);
		$this->runningTasks = intval($runningTasks);
		$this->upTime = intval($upTime);
		$this->users = intval($users);
		$this->version = $version;
	}
	
	public function getApplications() {
		return $this->applications;
	}
	
	public function getClusterNodesConfigured() {
		return $this->clusterNodesConfigured;
	}
	
	public function getClusterNodesRunning() {
		return $this->clusterNodesRunning;
	}
	
	public function getLicensedUsers() {
		return $this->licensedUsers;
	}
	
	public function getProcessModelVersions() {
		return $this->processModelVersions;
	}
	
	public function getProcessModelVersionsDeleted() {
		return $this->processModelVersionsDeleted;
	}
	
	public function getProcessModels() {
		return $this->processModels;
	}
	
	public function getRunningCases() {
		return $this->runningCases;
	}
	
	public function getRunningTasks() {
		return $this->runningTasks;
	}
	
	public function getUpTime() {
		return $this->upTime;
	}
	
	public function getUsers() {
		return $this->users;
	}
	
	public function getVersion() {
		return $this->version;
	}
}