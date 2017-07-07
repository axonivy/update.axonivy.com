<?php
namespace axonivy\update\repository;

use PDO;
use axonivy\update\model\DesignerLogRecord;
use axonivy\update\model\Java;
use axonivy\update\model\Memory;
use axonivy\update\model\Network;
use axonivy\update\model\OperatingSystem;
use axonivy\update\model\Designer;
use axonivy\update\model\HttpRequest;

class DesignerLogRepository
{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function find($idFrom, $count)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM DesignerLog WHERE Id > :idFrom ORDER BY Id ASC LIMIT :count');
        $stmt->bindValue(':idFrom', $idFrom, PDO::PARAM_INT);
        $stmt->bindValue(':count', $count, PDO::PARAM_INT);
        $stmt->execute();
        
        $records = $stmt->fetchAll();
        
        $logs = [];
        foreach ($records as $record) {
            $logs[] = $this->mapDesignerLogRecord($record);
        }
        return $logs;
    }

    private function mapDesignerLogRecord($record): DesignerLogRecord
    {
        $httpRequest = $this->mapHttpRequest($record);
        $java = $this->mapJava($record);
        $designer = $this->mapDesigner($record);
        $memory = $this->mapMemory($record);
        $network = $this->mapNetwork($record);
        $operatingSystem = $this->mapOperatingSystem($record);
        
        $log = new DesignerLogRecord($record['Timestamp'], $httpRequest, $java, $designer, $memory, $network, $operatingSystem);
        $log->setId($record['Id']);
        
        return $log;
    }
    
    private function mapHttpRequest($record): HttpRequest
    {
        return new HttpRequest(
            $record['HttpRequestIpAddress']
        );
    }

	private function mapDesigner($record): Designer
	{
	    return new Designer(
	        $record['DesignerVersion']
	    );
	}

    private function mapJava($record): Java
	{
	    return new Java(
	        $record['JavaVendor'],
	        $record['JavaVersion'],
	        $record['JavaVirtualMachineName'],
	        $record['JavaVirtualMachineVendor'],
	        $record['JavaVirtualMachineVersion']
	    );
	}
	
	private function mapMemory($record): Memory
	{
	    return new Memory(
	        $record['MemoryMaxHeap'],
	        $record['MemoryMaxNonHeap']
	   );
	}
	
	private function mapNetwork($record): Network
	{
	    return new Network(
	        $record['NetworkHardwareAddress'],
	        $record['NetworkIpAddress'],
	        $record['NetworkHostName']
	    );
	}
	
	private function mapOperatingSystem($record): OperatingSystem
	{
	    return new OperatingSystem(
	        $record['OperatingSystemArchitecture'],
	        $record['OperatingSystemName'],
	        $record['OperatingSystemVersion'],
	        $record['OperatingSystemAvailableProcessors']
	    );
	}
	
	public function write(DesignerLogRecord $record) {
		$stmt = $this->pdo->prepare('INSERT INTO DesignerLog (
			Timestamp,
            HttpRequestIpAddress,
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
            :HttpRequestIpAddress,
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
		$stmt->bindValue(':HttpRequestIpAddress', $record->getHttpRequest()->getIpAddress());

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
