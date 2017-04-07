<?php
namespace request;

use model\Java;
use model\Licence;
use model\Designer;
use model\Engine;
use model\Memory;
use model\Network;
use model\OperatingSystem;
use model\SystemDatabase;

class AddLogRequestHelper {
		
	public static function createJava() {
		$vendor = self::POST('JavaVendor');
		$version = self::POST('JavaVersion');
		$vmName = self::POST('JavaVirtualMachineName');
		$vmVendor = self::POST('JavaVirtualMachineVendor');
		$vmVersion = self::POST('JavaVirtualMachineVersion');
		
		return new Java($vendor, $version, $vmName, $vmVendor, $vmVersion);
	}
	
	public static function createLicence() {
		$id = self::POST('LicenceNumber');
		$individual = self::POST('LicenceeIndividual');
		$organisation = self::POST('LicenceeOrganisation');
		
		return new Licence(
			$id,
			$individual,
			$organisation
		);
	}
	
	public static function createDesigner() {
		$version = self::POST('DesignerVersion');
		
		return new Designer($version);
	}
	
	public static function createEngine() {
		$applications = self::POST('ServerApplications');
		$clusterNodesConfigured = self::POST('ServerClusterNodesConfigured');
		$clusterNodesRunning = self::POST('ServerClusterNodesRunning');
		$licensedUsers = self::POST('ServerLicensedUsers');
		$processModelVersions = self::POST('ServerProcessModelVersions');
		$processModelVersionsDeleted = self::POST('ServerProcessModelVersionsDeleted');
		$processModels= self::POST('ServerProcessModels');
		$runningCases = self::POST('ServerRunningCases');
		$runningTasks = self::POST('ServerRunningTasks');
		$upTime = self::POST('ServerUpTime');
		$users = self::POST('ServerUsers');
		$version = self::POST('ServerVersion');
		
		return new Engine(
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
			$version
		);
	}
	
	public static function createMemory() {
		$maxHeapMemory = self::POST('MemoryMaxHeap');
		$maxNonHeapMemory = self::POST('MemoryMaxNonHeap');
		
		return new Memory($maxHeapMemory, $maxNonHeapMemory);
	}
	
	public static function createNetwork() {
		$hostName = self::POST('NetworkHostName');
		$ipAddress = self::POST('NetworkIpAddress');
		$hardwareAddress = self::POST('NetworkHardwareAddress');	
		
		return new Network(
			$hardwareAddress,
			$ipAddress,
			$hostName
		);
	}
	
	public static function createOperatingSystem() {
		$architecture = self::POST('OperatingSystemArchitecture');
		$name = self::POST('OperatingSystemName');
		$version = self::POST('OperatingSystemVersion');
		$availableProcessors = self::POST('OperatingSystemAvailableProcessors');	
		
		return new OperatingSystem($architecture, $name, $version, $availableProcessors);
	}
	
	public static function createSystemDatabase() {
		$id = self::POST('SystemDatabaseId');
		$driver = self::POST('SystemDatabaseDriver');
		$productName = self::POST('SystemDatabaseProductName');
		$productVersion = substr(self::POST('SystemDatabaseProductVersion'), 0, 50);
		
		return new SystemDatabase($id, $driver, $productName, $productVersion);
	}
	
	private static function POST($getParameterName) {
		if (isset($_POST[$getParameterName])) {
			return $_POST[$getParameterName];
		} else {
			return '';
		}
	}
	
}