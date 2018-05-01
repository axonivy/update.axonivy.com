<?php
use PHPUnit\Framework\TestCase;
use axonivy\update\repository\ReleaseInfoRepository;

final class ReleaseInfoRepositoryTest extends TestCase
{

    public function testGetCurrentReleaseInfo()
    {
        $testee = new ReleaseInfoRepository('http://prototype.axonivya.myhostpoint.ch/api');
        $response = $testee->getCurrentReleaseInfo('7.0.1');
        $this->assertGreaterThanOrEqual(5, strlen($response->latestReleaseVersion));
        $this->assertGreaterThanOrEqual(5, strlen($response->latestServiceReleaseVersion));
    }
    
}
