<?php
namespace repository;

use PDO;
use repository\Repository;
use model\EngineLogRecord;

class EngineLogRepository extends Repository {
	
	public function find($idFrom, $count) {
		$stmt = $this->pdo->prepare('SELECT * FROM EngineLog WHERE Id > :idFrom ORDER BY Id ASC LIMIT :count');
		$stmt->bindValue(':idFrom', $idFrom, PDO::PARAM_INT);
		$stmt->bindValue(':count', $count, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}
	
	public function write(EngineLogRecord $record) {
		$stmt = $this->pdo->prepare('INSERT INTO EngineLog (
			Timestamp,
			
			EngineVersion,
			EngineUpTime,
			EngineClusterNodesConfigured,
			EngineClusterNodesRunning,
			EngineUsers,
			EngineLicensedUsers,
			EngineApplications,
			EngineProcessModels,
			EngineProcessModelVersions,
			EngineProcessModelVersionsDeleted,
			EngineRunningCases,
			EngineRunningTasks,
			
			LicenceNumber,
			LicenceeOrganisation,
			LicenceeIndividual,
			
			SystemDatabaseProductName,
			SystemDatabaseProductVersion,
			SystemDatabaseDriver,
			SystemDatabaseId,
			
			OperatingSystemName,
			OperatingSystemArchitecture,
			OperatingSystemVersion,
			OperatingSystemAvailableProcessors,
			
			NetworkHostName,
			NetworkIpAddress,
			NetworkHardwareAddress,
			
			MemoryMaxHeap,
			MemoryMaxNonHeap,
			
			JavaVersion,
			JavaVendor,
			JavaVirtualMachineVersion,
			JavaVirtualMachineVendor,
			JavaVirtualMachineName
		) VALUES (
			:Timestamp,
			
			:EngineVersion,
			:EngineUpTime,
			:EngineClusterNodesConfigured,
			:EngineClusterNodesRunning,
			:EngineUsers,
			:EngineLicensedUsers,
			:EngineApplications,
			:EngineProcessModels,
			:EngineProcessModelVersions,
			:EngineProcessModelVersionsDeleted,
			:EngineRunningCases,
			:EngineRunningTasks,
			
			:LicenceNumber,
			:LicenceeOrganisation,
			:LicenceeIndividual,
			
			:SystemDatabaseProductName,
			:SystemDatabaseProductVersion,
			:SystemDatabaseDriver,
			:SystemDatabaseId,
			
			:OperatingSystemName,
			:OperatingSystemArchitecture,
			:OperatingSystemVersion,
			:OperatingSystemAvailableProcessors,
			
			:NetworkHostName,
			:NetworkIpAddress,
			:NetworkHardwareAddress,
			
			:MemoryMaxHeap,
			:MemoryMaxNonHeap,
			
			:JavaVersion,
			:JavaVendor,
			:JavaVirtualMachineVersion,
			:JavaVirtualMachineVendor,
			:JavaVirtualMachineName
		)');
		
		$stmt->bindValue(':Timestamp', date('Y-m-d H:i:s', $record->getTimestamp()));
		
		$stmt->bindValue(':EngineVersion', $record->getEngine()->getVersion());
		$stmt->bindValue(':EngineUpTime', $record->getEngine()->getUpTime(), PDO::PARAM_INT);
		$stmt->bindValue(':EngineClusterNodesConfigured', $record->getEngine()->getClusterNodesConfigured(), PDO::PARAM_INT);
		$stmt->bindValue(':EngineClusterNodesRunning', $record->getEngine()->getClusterNodesRunning(), PDO::PARAM_INT);
		$stmt->bindValue(':EngineUsers', $record->getEngine()->getUsers(), PDO::PARAM_INT);
		$stmt->bindValue(':EngineLicensedUsers', $record->getEngine()->getLicensedUsers(), PDO::PARAM_INT);
		$stmt->bindValue(':EngineApplications', $record->getEngine()->getApplications(), PDO::PARAM_INT);
		$stmt->bindValue(':EngineProcessModels', $record->getEngine()->getProcessModels(), PDO::PARAM_INT);
		$stmt->bindValue(':EngineProcessModelVersions', $record->getEngine()->getProcessModelVersions(), PDO::PARAM_INT);
		$stmt->bindValue(':EngineProcessModelVersionsDeleted', $record->getEngine()->getProcessModelVersionsDeleted(), PDO::PARAM_INT);
		$stmt->bindValue(':EngineRunningCases', $record->getEngine()->getRunningCases(), PDO::PARAM_INT);
		$stmt->bindValue(':EngineRunningTasks', $record->getEngine()->getRunningTasks(), PDO::PARAM_INT);
		
		$stmt->bindValue(':LicenceNumber', $record->getLicence()->getId());
		$stmt->bindValue(':LicenceeOrganisation', $record->getLicence()->getOrganisation());
		$stmt->bindValue(':LicenceeIndividual', $record->getLicence()->getIndividual());
		
		$stmt->bindValue(':SystemDatabaseProductName', $record->getSystemDatabase()->getProductName());
		$stmt->bindValue(':SystemDatabaseProductVersion', $record->getSystemDatabase()->getProductVersion());
		$stmt->bindValue(':SystemDatabaseDriver', $record->getSystemDatabase()->getDriver());
		$stmt->bindValue(':SystemDatabaseId', $record->getSystemDatabase()->getId());
		
		$stmt->bindValue(':OperatingSystemName', $record->getOperatingSystem()->getName());
		$stmt->bindValue(':OperatingSystemArchitecture', $record->getOperatingSystem()->getArchitecture());
		$stmt->bindValue(':OperatingSystemVersion', $record->getOperatingSystem()->getVersion());
		$stmt->bindValue(':OperatingSystemAvailableProcessors', $record->getOperatingSystem()->getAvailableProcessors(), PDO::PARAM_INT);
		
		$stmt->bindValue(':NetworkHostName', $record->getNetwork()->getNetworkHostName());
		$stmt->bindValue(':NetworkIpAddress', $record->getNetwork()->getIpAddress());
		$stmt->bindValue(':NetworkHardwareAddress', $record->getNetwork()->getHardwareAddress());
		
		$stmt->bindValue(':MemoryMaxHeap', $record->getMemory()->getMaxHeapMemory(), PDO::PARAM_INT);
		$stmt->bindValue(':MemoryMaxNonHeap', $record->getMemory()->getMaxNonHeapMemory(), PDO::PARAM_INT);
		
		$stmt->bindValue(':JavaVersion', $record->getJava()->getVersion());
		$stmt->bindValue(':JavaVendor', $record->getJava()->getVendor());
		$stmt->bindValue(':JavaVirtualMachineVersion', $record->getJava()->getVmVersion());
		$stmt->bindValue(':JavaVirtualMachineVendor', $record->getJava()->getVmVendor());
		$stmt->bindValue(':JavaVirtualMachineName', $record->getJava()->getVmName());
		
		$stmt->execute();
	}
	
}