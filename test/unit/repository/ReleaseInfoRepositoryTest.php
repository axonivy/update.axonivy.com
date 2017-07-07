<?php
use PHPUnit\Framework\TestCase;
use axonivy\update\repository\ReleaseInfoRepository;
use axonivy\update\model\ReleaseInfo;

final class ReleaseInfoRepositoryTest extends TestCase
{

    public function testGetLatestRelease_testcase1()
    {
        $testee = new ReleaseInfoRepository('./test/testdata/releaseDirectory/testcase1');
                
        $this->assertReleaseInfo($testee->getLatestRelease(), '5.2.0.53277');
        $this->assertReleaseInfo($testee->getLatestServiceRelease('5.0.0'), '5.0.0.53277');
    }
    
    public function testGetLatestRelease_testcase2()
    {
        $testee = new ReleaseInfoRepository('./test/testdata/releaseDirectory/testcase2');
        
        $this->assertReleaseInfo($testee->getLatestRelease(), '6.5.11.53277');
        $this->assertReleaseInfo($testee->getLatestServiceRelease('5.0.0'), '6.5.11.53277');
    }
    
    private function assertReleaseInfo(ReleaseInfo $releaseInfo, string $version)
    {
        $this->assertEquals($version, $releaseInfo->getVersion());
        $this->assertEquals('http://developer.axonivy.com/download/', $releaseInfo->getDownloadUrl());
    }
}
