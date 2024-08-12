<?php
use axonivy\update\Application;
use Slim\Psr7\Factory\RequestFactory;
use Slim\Psr7\Response;
use Slim\App;
use Slim\Psr7\Factory\StreamFactory;

require_once 'IntegrationTestCase.php';

final class CallingHomeControllerV2Test extends IntegrationTestCase
{
    public function testUpdateJsonEngine(): void 
    {
        $usage = '{ 
            "Java" : {  
                "version" : "21.0.3",
                "vendor": "Eclipse Adoptium"
            },
            "Network" : {
                "hostName" : "zugnbrew",
                "ipAddress" : "1234354354343"
            },
            "IvyProduct" : {
                "name" : "Engine",
                "version" : "10.0.19"
            }
        }';

        $response = $this->fireRequest('/api/update/product', $usage);
        $latest = json_decode($response->getBody());

        $this->assertVersionNumber($latest->latestReleaseVersion);
        $this->assertVersionNumber($latest->latestServiceReleaseVersion);
        $this->assertEquals('https://developer.axonivy.com/download/', $latest->url);
    }

    public function testUpdateJsonDesigner(): void 
    {
        $usage = '{ 
            "IvyProduct" : {
                "name" : "Designer",
                "version" : "10.0.19"
            }
        }';

        $response = $this->fireRequest('/api/update/product', $usage);
        $latest = json_decode($response->getBody());

        $this->assertVersionNumber($latest->latestReleaseVersion);
        $this->assertVersionNumber($latest->latestServiceReleaseVersion);
        $this->assertEquals('https://developer.axonivy.com/download/', $latest->url);
    }

    private function fireRequest(String $url, String $json): Response
    {
        $payload = (new StreamFactory())->createStream($json);
        $request = (new RequestFactory())
            ->createRequest('POST', $url)
            ->withBody($payload)
            ->withHeader('Content-Type', 'application/json');
        return $this->app()->handle($request);
    }
    
    private function app(): App
    {
        $configuration = [
            'settings' => [
                'displayErrorDetails' => true,
                'db' => $this->dbConfig,
                'developerAPI' => 'https://developer.axonivy.com/api'
            ]
        ];
        return (new Application())->createApp($configuration);
    }
    
    private function assertVersionNumber($version)
    {
        $this->assertEquals(-1, version_compare(5, $version));
        $parts = explode('.', $version);
        $this->assertTrue(is_numeric($parts[0]));
        $this->assertTrue(is_numeric($parts[1]));
        $this->assertTrue(is_numeric($parts[2]));
    }
}