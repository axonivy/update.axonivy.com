<?php
namespace request;

use Exception;
use request\RequestHandler;
use repository\DesignerLogRepository;
use repository\EngineLogRepository;
use config\Config;

class LogReaderRequestHandler extends RequestHandler {
	
	private $designerLogRepo;
	private $engineLogRepo;
	
	public function __construct() {
		$this->designerLogRepo = new DesignerLogRepository();
		$this->engineLogRepo = new EngineLogRepository();
	}
	
	public function getRequestMethod() {
		return 'GET';
	}
	
	public function getUrlPath() {
		return '/api/log';
	}
	
	public function execute() {
		$this->checkAuthentication();
		
		$type = $_GET['type'];
		$idFrom = $_GET['idFrom'];
		$count = $_GET['count'];
		
		$logs;
		if ($type == 'designer') {
			$designerLogs = $this->designerLogRepo->find($idFrom, $count);
			$logs = $this->mapDesignerLogs($designerLogs);
		} elseif ($type == 'engine') {
			$engineLogs = $this->engineLogRepo->find($idFrom, $count);			
			$logs = $this->mapEngineLogs($engineLogs);
		} else {
			throw new Exception('not a valid type');
		}
		echo json_encode($logs, JSON_PRETTY_PRINT);
	}
	
	private function checkAuthentication() {
		if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER'] != Config::API_USERNAME) {
			$this->throwForbiddenException();
		}
		if (!isset($_SERVER['PHP_AUTH_PW']) || $_SERVER['PHP_AUTH_PW'] != Config::API_PASSWORD) {
			$this->throwForbiddenException();
		}
	}
	
	private function throwForbiddenException() {
		header('HTTP/1.0 403 Forbidden');
		die('You are not allowed to access this ressource.');
	}
	
	private function mapDesignerLogs($designerLogs) {
		$logs = [];
		foreach ($designerLogs as $designerLog) {
			$logs[] = [
				'Id' => $designerLog->getId(),
				'Timestamp' => $designerLog->getTimestamp(),
				
				'DesignerVersion' => $designerLog->getDesignerVersion(),
				
				'OperatingSystemName' => $designerLog->getOperatingSystem()->getName(),
				'OperatingSystemVersion' => $designerLog->getOperatingSystem()->getVersion(),
				'OperatingSystemArchitecture' => $designerLog->getOperatingSystem()->getArchitecture(),
				'OperatingSystemAvailableProcessors' => $designerLog->getOperatingSystem()->getAvailableProcessors(),
				
				'MemoryMaxHeap' => $designerLog->getMemory()->getMaxHeapMemory(),
				'MemoryMaxNonHeap' => $designerLog->getMemory()->getMaxNonHeapMemory(),
								
				'NetworkHostName' => $designerLog->getNetwork()->getIpAddress(),
				'NetworkIpAddress' => $designerLog->getNetwork()->getNetworkHostname(),
				'NetworkHardwareAddress' => $designerLog->getNetwork()->getHardwareAddress(),
				
				'JavaVendor' => $designerLog->getJava()->getVendor(),
				'JavaVersion' => $designerLog->getJava()->getVersion(),
				'JavaVirtualMachineName' => $designerLog->getJava()->getVmName(),
				'JavaVirtualMachineVendor' => $designerLog->getJava()->getVmVendor(),
				'JavaVirtualMachineVersion' => $designerLog->getJava()->getVmVersion(),
			];
		}
		return $logs;
	}
	
	private function mapEngineLogs($engineLogs) {
		$logs = [];
		foreach ($engineLogs as $engineLog) {
			$logs[] = [
				'Id' => $engineLog->getId(),
				'Timestamp' => $engineLog->getTimestamp(),
				
				'EngineVersion' => $engineLog->getEngine()->getVersion(),
				'EngineUpTime' => $engineLog->getEngine()->getUpTime(),
				'EngineUsers' => $engineLog->getEngine()->getUsers(),
				'EngineLicensedUsers' => $engineLog->getEngine()->getLicensedUsers(),
				'EngineApplications' => $engineLog->getEngine()->getApplications(),
				'EngineProcessModels' => $engineLog->getEngine()->getProcessModels(),
				'EngineProcessModelVersions' => $engineLog->getEngine()->getProcessModelVersions(),
				'EngineProcessModelVersionsDeleted' => $engineLog->getEngine()->getProcessModelVersionsDeleted(),
				'EngineClusterNodesConfigured' =>  $engineLog->getEngine()->getClusterNodesConfigured(),				
				'EngineClusterNodesRunning' => $engineLog->getEngine()->getClusterNodesRunning(),
				'EngineRunningCases' => $engineLog->getEngine()->getRunningCases(),
				'EngineRunningTasks' => $engineLog->getEngine()->getRunningTasks(),
				
				'OperatingSystemName' => $engineLog->getOperatingSystem()->getName(),
				'OperatingSystemVersion' => $engineLog->getOperatingSystem()->getVersion(),
				'OperatingSystemArchitecture' => $engineLog->getOperatingSystem()->getArchitecture(),
				'OperatingSystemAvailableProcessors' => $engineLog->getOperatingSystem()->getAvailableProcessors(),
				
				'MemoryMaxHeap' => $engineLog->getMemory()->getMaxHeapMemory(),
				'MemoryMaxNonHeap' => $engineLog->getMemory()->getMaxNonHeapMemory(),
				
				'SystemDatabaseDriver' => $engineLog->getSystemDatabase()->getDriver(),
				'SystemDatabaseProductName' => $engineLog->getSystemDatabase()->getProductName(),
				'SystemDatabaseId' => $engineLog->getSystemDatabase()->getId(),
				'SystemDatabaseProductVersion' => $engineLog->getSystemDatabase()->getProductVersion(),
				
				'LicenceNumber' => $engineLog->getLicence()->getId(),
				'LicenceeIndividual' => $engineLog->getLicence()->getIndividual(),
				'LicenceeOrganisation' => $engineLog->getLicence()->getOrganisation(),
				
				'NetworkHostName' => $engineLog->getNetwork()->getIpAddress(),
				'NetworkIpAddress' => $engineLog->getNetwork()->getNetworkHostname(),
				'NetworkHardwareAddress' => $engineLog->getNetwork()->getHardwareAddress(),
				
				'JavaVendor' => $engineLog->getJava()->getVendor(),
				'JavaVersion' => $engineLog->getJava()->getVersion(),
				'JavaVirtualMachineName' => $engineLog->getJava()->getVmName(),
				'JavaVirtualMachineVendor' => $engineLog->getJava()->getVmVendor(),
				'JavaVirtualMachineVersion' => $engineLog->getJava()->getVmVersion(),
			];
		}
		return $logs;
	}
}
