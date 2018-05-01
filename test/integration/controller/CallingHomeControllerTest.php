<?php
use axonivy\update\Application;
use axonivy\update\repository\DesignerLogRepository;
use axonivy\update\repository\EngineLogRepository;

require_once 'IntegrationTestCase.php';

final class CallingHomeControllerTest extends IntegrationTestCase
{
    public function testAddDesignerLog(): void
    {
        $configuration = [
            'settings' => [
                'displayErrorDetails' => true,
                'db' => $this->dbConfig,
                'api' => [
                    'username' => 'ivyTeam',
                    'password' => '???'
                ],
                'developerAPI' => 'http://prototype.axonivya.myhostpoint.ch/api'
            ],
            'environment' => \Slim\Http\Environment::mock([
                'REQUEST_METHOD' => 'POST',
                'REQUEST_URI' => '/ivy/pro/UpdateService/UpdateService/141746D7E212F6D2/designer.ivp',
                'HTTP_AUTHORIZATION' => 'Basic aXZ5VGVhbTo/Pz8=',
                'HTTP_CONTENT_TYPE' => 'application/x-www-form-urlencoded',
            ])
        ];
        
        $_POST['DesignerVersion'] = '5.1.4';
        
        $_POST['JavaVendor'] = 'JVendor';
        $_POST['JavaVersion'] = 'JVersion';
        $_POST['JavaVirtualMachineName'] = 'JVMName';
        $_POST['JavaVirtualMachineVendor'] = 'JVMVendor';
        $_POST['JavaVirtualMachineVersion'] = 'JVMVersion';
        
        $_POST['MemoryMaxHeap'] = '15';
        $_POST['MemoryMaxNonHeap'] = '9000';
        
        $_POST['NetworkHostName'] = 'zugpcthor';
        $_POST['NetworkIpAddress'] = '192.6.84.6';
        $_POST['NetworkHardwareAddress'] = '15415';
        
        $_POST['OperatingSystemArchitecture'] = 'intel';
        $_POST['OperatingSystemName'] = 'linux';
        $_POST['OperatingSystemVersion'] = '56';
        $_POST['OperatingSystemAvailableProcessors'] = '92';
        
        $response = (new Application())->runWithConfiguration($configuration);
        $plainText = $response->getBody();
        $plainTextArr = explode("\n", $plainText);
        
        $this->assertEquals('', $plainTextArr[0]);
        $this->assertEquals('', $plainTextArr[1]);
        
        $this->assertEquals('LatestRelease: 6.5.11.53277', $plainTextArr[2]);
        $this->assertEquals('LatestReleaseUrl: http://developer.axonivy.com/download/', $plainTextArr[3]);
        $this->assertEquals('LatestServiceReleaseForCurrentRelease: 5.1.11.53277', $plainTextArr[4]);
        $this->assertEquals('LatestServiceReleaseForCurrentReleaseUrl: http://developer.axonivy.com/download/', $plainTextArr[5]);
        
        $pdo = Application::createContainer($configuration)->db;
        $logRep = new DesignerLogRepository($pdo);
        $logs = $logRep->find(0, 1);
        $log = $logs[0];
        
        $this->assertEquals('5.1.4', $log->getDesigner()->getVersion());
        
        $this->assertEquals('JVendor', $log->getJava()->getVendor());
        $this->assertEquals('JVersion', $log->getJava()->getVersion());
        $this->assertEquals('JVMName', $log->getJava()->getVmName());
        $this->assertEquals('JVMVendor', $log->getJava()->getVmVendor());
        $this->assertEquals('JVMVersion', $log->getJava()->getVmVersion());
        
        $this->assertEquals(15, $log->getMemory()->getMaxHeapMemory());
        $this->assertEquals(9000, $log->getMemory()->getMaxNonHeapMemory());
        
        $this->assertEquals('15415', $log->getNetwork()->getHardwareAddress());
        $this->assertEquals('192.6.84.6', $log->getNetwork()->getIpAddress());
        $this->assertEquals('zugpcthor', $log->getNetwork()->getNetworkHostName());
        
        $this->assertEquals('intel', $log->getOperatingSystem()->getArchitecture());
        $this->assertEquals(92, $log->getOperatingSystem()->getAvailableProcessors());
        $this->assertEquals('linux', $log->getOperatingSystem()->getName());
        $this->assertEquals('56', $log->getOperatingSystem()->getVersion());
    }
    
    public function testAddEngineLog(): void
    {
        $configuration = [
            'settings' => [
                'displayErrorDetails' => true,
                'db' => $this->dbConfig,
                'api' => [
                    'username' => 'ivyTeam',
                    'password' => '???'
                ],
                'developerAPI' => 'http://prototype.axonivya.myhostpoint.ch/api'
            ],
            'environment' => \Slim\Http\Environment::mock([
                'REQUEST_METHOD' => 'POST',
                'REQUEST_URI' => '/ivy/pro/UpdateService/UpdateService/141746D7E212F6D2/server.ivp',
                'HTTP_AUTHORIZATION' => 'Basic aXZ5VGVhbTo/Pz8=',
                'HTTP_CONTENT_TYPE' => 'application/x-www-form-urlencoded',
            ])
        ];
        
        $_POST['ServerVersion'] = '6.5';
        $_POST['ServerApplications'] = 10;
        $_POST['ServerClusterNodesConfigured'] = 20;
        $_POST['ServerClusterNodesRunning'] = 30;
        $_POST['ServerLicensedUsers'] = 40;
        $_POST['ServerProcessModelVersions'] = 50;
        $_POST['ServerProcessModelVersionsDeleted'] = 60;
        $_POST['ServerProcessModels'] = 70;
        $_POST['ServerRunningCases'] = 80;
        $_POST['ServerRunningTasks'] = 90;
        $_POST['ServerUpTime'] = 100;
        $_POST['ServerUsers'] = 110;
        
        $_POST['JavaVendor'] = 'Oraci';
        $_POST['JavaVersion'] = '18.dj3';
        $_POST['JavaVirtualMachineName'] = 'this is a name';
        $_POST['JavaVirtualMachineVendor'] = 'this is a vendor';
        $_POST['JavaVirtualMachineVersion'] = 'this is av ersion';
        
        $_POST['MemoryMaxHeap'] = '50000';
        $_POST['MemoryMaxNonHeap'] = '90';
        
        $_POST['NetworkHostName'] = 'suspci';
        $_POST['NetworkIpAddress'] = '148.4';
        $_POST['NetworkHardwareAddress'] = 'dafeoj';
        
        $_POST['OperatingSystemArchitecture'] = 'amd';
        $_POST['OperatingSystemName'] = 'windows';
        $_POST['OperatingSystemVersion'] = '1';
        $_POST['OperatingSystemAvailableProcessors'] = '2';
        
        $_POST['LicenceNumber'] = '5';
        $_POST['LicenceeIndividual'] = 'hulkhogan';
        $_POST['LicenceeOrganisation'] = 'avengers';
        
        $_POST['SystemDatabaseId'] = '666';
        $_POST['SystemDatabaseDriver'] = 'jdbcmysql';
        $_POST['SystemDatabaseProductName'] = 'sun microsystem';
        $_POST['SystemDatabaseProductVersion'] = '66666';
        
        $response = (new Application())->runWithConfiguration($configuration);
        $plainText = $response->getBody();
        $plainTextArr = explode("\n", $plainText);
        
        $this->assertEquals('', $plainTextArr[0]);
        $this->assertEquals('', $plainTextArr[1]);
        
        $this->assertEquals('LatestRelease: 6.5.11.53277', $plainTextArr[2]);
        $this->assertEquals('LatestReleaseUrl: http://developer.axonivy.com/download/', $plainTextArr[3]);
        $this->assertEquals('LatestServiceReleaseForCurrentRelease: 6.5.11.53277', $plainTextArr[4]);
        $this->assertEquals('LatestServiceReleaseForCurrentReleaseUrl: http://developer.axonivy.com/download/', $plainTextArr[5]);
        
        $pdo = Application::createContainer($configuration)->db;
        $logRep = new EngineLogRepository($pdo);
        $logs = $logRep->find(0, 1);
        $log = $logs[0];
        
        $this->assertEquals('6.5', $log->getEngine()->getVersion());
        $this->assertEquals(10, $log->getEngine()->getApplications());
        $this->assertEquals(20, $log->getEngine()->getClusterNodesConfigured());
        $this->assertEquals(30, $log->getEngine()->getClusterNodesRunning());
        $this->assertEquals(40, $log->getEngine()->getLicensedUsers());
        $this->assertEquals(50, $log->getEngine()->getProcessModelVersions());
        $this->assertEquals(60, $log->getEngine()->getProcessModelVersionsDeleted());
        $this->assertEquals(70, $log->getEngine()->getProcessModels());
        $this->assertEquals(80, $log->getEngine()->getRunningCases());
        $this->assertEquals(90, $log->getEngine()->getRunningTasks());
        $this->assertEquals(100, $log->getEngine()->getUpTime());
        $this->assertEquals(110, $log->getEngine()->getUsers());
        
        $this->assertEquals('Oraci', $log->getJava()->getVendor());
        $this->assertEquals('18.dj3', $log->getJava()->getVersion());
        $this->assertEquals('this is a name', $log->getJava()->getVmName());
        $this->assertEquals('this is a vendor', $log->getJava()->getVmVendor());
        $this->assertEquals('this is av ersion', $log->getJava()->getVmVersion());
        
        $this->assertEquals(50000, $log->getMemory()->getMaxHeapMemory());
        $this->assertEquals(90, $log->getMemory()->getMaxNonHeapMemory());
        
        $this->assertEquals('dafeoj', $log->getNetwork()->getHardwareAddress());
        $this->assertEquals('148.4', $log->getNetwork()->getIpAddress());
        $this->assertEquals('suspci', $log->getNetwork()->getNetworkHostName());
        
        $this->assertEquals('amd', $log->getOperatingSystem()->getArchitecture());
        $this->assertEquals(2, $log->getOperatingSystem()->getAvailableProcessors());
        $this->assertEquals('windows', $log->getOperatingSystem()->getName());
        $this->assertEquals('1', $log->getOperatingSystem()->getVersion());
        
        $this->assertEquals('5', $log->getLicence()->getId());
        $this->assertEquals('hulkhogan', $log->getLicence()->getIndividual());
        $this->assertEquals('avengers', $log->getLicence()->getOrganisation());
        
        $this->assertEquals('666', $log->getSystemDatabase()->getId());
        $this->assertEquals('jdbcmysql', $log->getSystemDatabase()->getDriver());
        $this->assertEquals('sun microsystem', $log->getSystemDatabase()->getProductName());
        $this->assertEquals('66666', $log->getSystemDatabase()->getProductVersion());
    }
    
}