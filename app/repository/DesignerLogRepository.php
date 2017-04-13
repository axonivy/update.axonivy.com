<?php
namespace repository;

use PDO;
use repository\Repository;
use model\DesignerLogRecord;
use model\Java;
use model\Memory;
use model\Network;
use model\OperatingSystem;
use model\Designer;

class DesignerLogRepository extends Repository {
	
	public function find($idFrom, $count) {
		$stmt = $this->pdo->prepare('SELECT * FROM DesignerLog WHERE Id > :idFrom ORDER BY Id ASC LIMIT :count');
		$stmt->bindValue(':idFrom', $idFrom, PDO::PARAM_INT);
		$stmt->bindValue(':count', $count, PDO::PARAM_INT);
		$stmt->execute();
		$records = $stmt->fetchAll();
		
		$logs = [];
		foreach ($records as $record) {
			$java = new Java(
				$record['JavaVendor'],
				$record['JavaVersion'],
				$record['JavaVirtualMachineName'],
				$record['JavaVirtualMachineVendor'],
				$record['JavaVirtualMachineName']
			);
			$memory = new Memory(
				$record['MemoryMaxHeap'],
				$record['MemoryMaxNonHeap']
			);
			$network = new Network(
				$record['NetworkHardwareAddress'],
				$record['NetworkIpAddress'],
				$record['NetworkHostName']
			);
			$operatingSystem = new OperatingSystem(
				$record['OperatingSystemArchitecture'],
				$record['OperatingSystemName'],
				$record['OperatingSystemVersion'],
				$record['OperatingSystemAvailableProcessors']
			);
			$designer = new Designer(
				$record['DesignerVersion']
			);
			
			$log = new DesignerLog(
				$record['Timestamp'],
				$java,
				$designer,
				$memory,
				$network,
				$operatingSystem
			);
			$log->setId($record['Id']);
			$logs[] = $log;			
		}
		return $logs;
	}
	
	public function write(DesignerLogRecord $record) {
		$stmt = $this->pdo->prepare('INSERT INTO DesignerLog (
			Timestamp,
			DesignerVersion,
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
			:DesignerVersion,
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
		$stmt->bindValue(':DesignerVersion', $record->getDesigner()->getVersion());
		
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
