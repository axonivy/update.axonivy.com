<?php
namespace axonivy\update\controller;

use Exception;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use axonivy\update\repository\DesignerLogRepository;
use axonivy\update\repository\EngineLogRepository;

class LogController
{

    private static $TYPE_DESIGNER = 'designer';

    private static $TYPE_ENGINE = 'engine';

    private $designerLogRepo;

    private $engineLogRepo;

    public function __construct(DesignerLogRepository $designerLogRepo, EngineLogRepository $engineLogRepo)
    {
        $this->designerLogRepo = $designerLogRepo;
        $this->engineLogRepo = $engineLogRepo;
    }

    public function read(Request $request, Response $response)
    {
        $queryParams = $request->getQueryParams();
        $type = $queryParams['type'];
        $idFrom = isset($queryParams['idFrom']) ? $queryParams['idFrom'] : 0;
        $count = isset($queryParams['count']) ? $queryParams['count'] : 1;

        $logs;
        if ($type == self::$TYPE_DESIGNER) {
            $designerLogs = $this->designerLogRepo->find($idFrom, $count);
            $logs = $this->mapDesignerLogs($designerLogs);
        } elseif ($type == self::$TYPE_ENGINE) {
            $engineLogs = $this->engineLogRepo->find($idFrom, $count);
            $logs = $this->mapEngineLogs($engineLogs);
        } else {
            throw new Exception('not a valid type');
        }
        
        return $response->withJson($logs, null, JSON_PRETTY_PRINT);
    }

    private function mapDesignerLogs($designerLogs): array
    {
        $logs = [];
        foreach ($designerLogs as $designerLog) {
            $logs[] = [
                'Id' => $designerLog->getId(),
                'Timestamp' => $designerLog->getTimestamp(),
                
                'DesignerVersion' => $designerLog->getDesigner()->getVersion(),
                
                'HttpRequestIpAddress' => $designerLog->getHttpRequest()->getIpAddress(),
                
                'OperatingSystemName' => $designerLog->getOperatingSystem()->getName(),
                'OperatingSystemVersion' => $designerLog->getOperatingSystem()->getVersion(),
                'OperatingSystemArchitecture' => $designerLog->getOperatingSystem()->getArchitecture(),
                'OperatingSystemAvailableProcessors' => $designerLog->getOperatingSystem()->getAvailableProcessors(),
                
                'MemoryMaxHeap' => $designerLog->getMemory()->getMaxHeapMemory(),
                'MemoryMaxNonHeap' => $designerLog->getMemory()->getMaxNonHeapMemory(),
                
                'NetworkHostName' => $designerLog->getNetwork()->getNetworkHostname(),
                'NetworkIpAddress' => $designerLog->getNetwork()->getIpAddress(),
                'NetworkHardwareAddress' => $designerLog->getNetwork()->getHardwareAddress(),
                
                'JavaVendor' => $designerLog->getJava()->getVendor(),
                'JavaVersion' => $designerLog->getJava()->getVersion(),
                'JavaVirtualMachineName' => $designerLog->getJava()->getVmName(),
                'JavaVirtualMachineVendor' => $designerLog->getJava()->getVmVendor(),
                'JavaVirtualMachineVersion' => $designerLog->getJava()->getVmVersion()
            ];
        }
        return $logs;
    }

    private function mapEngineLogs($engineLogs): array
    {
        $logs = [];
        foreach ($engineLogs as $engineLog) {
            $logs[] = [
                'Id' => $engineLog->getId(),
                'Timestamp' => $engineLog->getTimestamp(),
                
                'HttpRequestIpAddress' => $engineLog->getHttpRequest()->getIpAddress(),
                
                'EngineVersion' => $engineLog->getEngine()->getVersion(),
                'EngineUpTime' => $engineLog->getEngine()->getUpTime(),
                'EngineUsers' => $engineLog->getEngine()->getUsers(),
                'EngineLicensedUsers' => $engineLog->getEngine()->getLicensedUsers(),
                'EngineApplications' => $engineLog->getEngine()->getApplications(),
                'EngineProcessModels' => $engineLog->getEngine()->getProcessModels(),
                'EngineProcessModelVersions' => $engineLog->getEngine()->getProcessModelVersions(),
                'EngineProcessModelVersionsDeleted' => $engineLog->getEngine()->getProcessModelVersionsDeleted(),
                'EngineClusterNodesConfigured' => $engineLog->getEngine()->getClusterNodesConfigured(),
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
                
                'NetworkHostName' => $engineLog->getNetwork()->getNetworkHostname(),
                'NetworkIpAddress' => $engineLog->getNetwork()->getIpAddress(),
                'NetworkHardwareAddress' => $engineLog->getNetwork()->getHardwareAddress(),
                
                'JavaVendor' => $engineLog->getJava()->getVendor(),
                'JavaVersion' => $engineLog->getJava()->getVersion(),
                'JavaVirtualMachineName' => $engineLog->getJava()->getVmName(),
                'JavaVirtualMachineVendor' => $engineLog->getJava()->getVmVendor(),
                'JavaVirtualMachineVersion' => $engineLog->getJava()->getVmVersion()
            ];
        }
        return $logs;
    }
}
