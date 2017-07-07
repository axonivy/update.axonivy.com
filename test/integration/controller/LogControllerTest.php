<?php
use axonivy\update\Application;

require_once 'IntegrationTestCase.php';

final class LogControllerTest extends IntegrationTestCase
{

    public function testReadLogDesigner(): void
    {
        $this->loadTestData();
        
        $configuration = [
            'settings' => [
                'displayErrorDetails' => true,
                'db' => $this->dbConfig,
                'api' => [
                    'username' => 'ivyTeam',
                    'password' => '???'
                ],
                'releaseDirectory' => ''
            ],
            'environment' => \Slim\Http\Environment::mock([
                'REQUEST_METHOD' => 'GET',
                'REQUEST_URI' => '/api/log',
                'QUERY_STRING' => 'type=designer&idFrom=0&count=2',
                'HTTP_AUTHORIZATION' => 'Basic aXZ5VGVhbTo/Pz8='
            ])
        ];
        
        $response = (new Application())->runWithConfiguration($configuration);
        
        $json = $response->getBody();
        $data = json_decode($json, true);
        
        $row = $data[0];
        
        $this->assertEquals(100, $row['Id']);
        
        $this->assertEquals('OS_NAME', $row['OperatingSystemName']);
        $this->assertEquals('OS_ARCH', $row['OperatingSystemArchitecture']);
        $this->assertEquals('OS_VERSION', $row['OperatingSystemVersion']);
        $this->assertEquals(8, $row['OperatingSystemAvailableProcessors']);
        
        $this->assertEquals('JAVA_VERSION', $row['JavaVersion']);
        $this->assertEquals('JAVA_VENDOR', $row['JavaVendor']);
        $this->assertEquals('JVM_VERSION', $row['JavaVirtualMachineVersion']);
        $this->assertEquals('JVM_VENDOR', $row['JavaVirtualMachineVendor']);
        $this->assertEquals('JVM_NAME', $row['JavaVirtualMachineName']);
        
        $this->assertEquals('255.666.75.45', $row['HttpRequestIpAddress']);
        
        
        $row = $data[1];
        
        $this->assertEquals(101, $row['Id']);
        
        $this->assertEquals('OS_NAME2', $row['OperatingSystemName']);
        $this->assertEquals('OS_ARCH2', $row['OperatingSystemArchitecture']);
        $this->assertEquals('OS_VERSION2', $row['OperatingSystemVersion']);
        $this->assertEquals(16, $row['OperatingSystemAvailableProcessors']);
        
        $this->assertEquals('JAVA_VERSION2', $row['JavaVersion']);
        $this->assertEquals('JAVA_VENDOR2', $row['JavaVendor']);
        $this->assertEquals('JVM_VERSION2', $row['JavaVirtualMachineVersion']);
        $this->assertEquals('JVM_VENDOR2', $row['JavaVirtualMachineVendor']);
        $this->assertEquals('JVM_NAME2', $row['JavaVirtualMachineName']);
        
        $this->assertEquals('255.666.75.5', $row['HttpRequestIpAddress']);
    }
    
    public function testReadLogEngine(): void
    {
        $this->loadTestData();
        
        $configuration = [
            'settings' => [
                'displayErrorDetails' => true,
                'db' => $this->dbConfig,
                'api' => [
                    'username' => 'ivyTeam',
                    'password' => '???'
                ],
                'releaseDirectory' => ''
            ],
            'environment' => \Slim\Http\Environment::mock([
                'REQUEST_METHOD' => 'GET',
                'REQUEST_URI' => '/api/log',
                'QUERY_STRING' => 'type=engine&idFrom=0&count=2',
                'HTTP_AUTHORIZATION' => 'Basic aXZ5VGVhbTo/Pz8='
            ])
        ];
        
        $response = (new Application())->runWithConfiguration($configuration);
        
        $json = $response->getBody();
        $data = json_decode($json, true);
        
        $row = $data[0];
        
        $this->assertEquals(100, $row['Id']);
        
        $this->assertEquals('OS_NAME', $row['OperatingSystemName']);
        $this->assertEquals('OS_ARCH', $row['OperatingSystemArchitecture']);
        $this->assertEquals('OS_VERSION', $row['OperatingSystemVersion']);
        $this->assertEquals(8, $row['OperatingSystemAvailableProcessors']);
        
        $this->assertEquals('JAVA_VERSION', $row['JavaVersion']);
        $this->assertEquals('JAVA_VENDOR', $row['JavaVendor']);
        $this->assertEquals('JVM_VERSION', $row['JavaVirtualMachineVersion']);
        $this->assertEquals('JVM_VENDOR', $row['JavaVirtualMachineVendor']);
        $this->assertEquals('JVM_NAME', $row['JavaVirtualMachineName']);
        
        $this->assertEquals('255.66.75.45', $row['HttpRequestIpAddress']);
        
        $this->assertEquals('LICENSE_NUMBER', $row['LicenceNumber']);
        $this->assertEquals('LICENSE_INDIVIDUAL', $row['LicenceeIndividual']);
        $this->assertEquals('LICENSE_ORGANISATION', $row['LicenceeOrganisation']);
        
        $this->assertEquals(5456, $row['SystemDatabaseId']);
        $this->assertEquals('DB_DRIVER', $row['SystemDatabaseDriver']);
        $this->assertEquals('DB_PRODUCT_NAME', $row['SystemDatabaseProductName']);
        $this->assertEquals('DB_PRODUCT_VERSION', $row['SystemDatabaseProductVersion']);
        
        $this->assertEquals('6.4.0', $row['EngineVersion']);
        $this->assertEquals(1000, $row['EngineUpTime']);
        $this->assertEquals(9, $row['EngineClusterNodesConfigured']);
        $this->assertEquals(8, $row['EngineClusterNodesRunning']);
        $this->assertEquals(7, $row['EngineUsers']);
        $this->assertEquals(5, $row['EngineLicensedUsers']);
        $this->assertEquals(4, $row['EngineApplications']);
        $this->assertEquals(3, $row['EngineProcessModels']);
        $this->assertEquals(2, $row['EngineProcessModelVersions']);
        $this->assertEquals(55, $row['EngineProcessModelVersionsDeleted']);
        $this->assertEquals(66, $row['EngineRunningCases']);
        $this->assertEquals(99, $row['EngineRunningTasks']);
    }
        
    public function testReadThreeLogRecords(): void
    {
        $this->loadTestData();
        
        $configuration = [
            'settings' => [
                'displayErrorDetails' => true,
                'db' => $this->dbConfig,
                'api' => [
                    'username' => 'ivyTeam',
                    'password' => '???'
                ],
                'releaseDirectory' => ''
            ],
            'environment' => \Slim\Http\Environment::mock([
                'REQUEST_METHOD' => 'GET',
                'REQUEST_URI' => '/api/log',
                'QUERY_STRING' => 'type=designer&idFrom=0&count=3',
                'HTTP_AUTHORIZATION' => 'Basic aXZ5VGVhbTo/Pz8='
            ])
        ];
        
        $response = (new Application())->runWithConfiguration($configuration);
        
        $json = $response->getBody();
        $data = json_decode($json, true);
        
        $this->assertEquals(100, $data[0]['Id']);
        $this->assertEquals(101, $data[1]['Id']);
        $this->assertEquals(102, $data[2]['Id']);
    }
    
    public function testReadTwoLogEntries(): void
    {
        $this->loadTestData();
        
        $configuration = [
            'settings' => [
                'displayErrorDetails' => true,
                'db' => $this->dbConfig,
                'api' => [
                    'username' => 'ivyTeam',
                    'password' => '???'
                ],
                'releaseDirectory' => ''
            ],
            'environment' => \Slim\Http\Environment::mock([
                'REQUEST_METHOD' => 'GET',
                'REQUEST_URI' => '/api/log',
                'QUERY_STRING' => 'type=designer&idFrom=100&count=2',
                'HTTP_AUTHORIZATION' => 'Basic aXZ5VGVhbTo/Pz8='
            ])
        ];
        
        $response = (new Application())->runWithConfiguration($configuration);
        
        $json = $response->getBody();
        $data = json_decode($json, true);
        
        $this->assertEquals(101, $data[0]['Id']);
        $this->assertEquals(102, $data[1]['Id']);
    }
    
    private function loadTestData()
    {
        $this->pdo->exec(file_get_contents('./test/testdata/testdata.sql'));
    }
}
