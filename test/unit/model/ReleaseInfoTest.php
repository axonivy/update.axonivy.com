<?php
use PHPUnit\Framework\TestCase;
use axonivy\update\model\ReleaseInfo;

final class ReleaseInfoTest extends TestCase
{
    
    public function testGetVersion()
    {
        $releaseInfo = new ReleaseInfo('6.5.1', 'http://download.axonivy.com/engine.zip');
        $this->assertEquals('6.5.1', $releaseInfo->getVersion());
    }
    
    public function testGetDownloadUrl()
    {
        $releaseInfo = new ReleaseInfo('6.5.1', 'http://download.axonivy.com/engine.zip');
        $this->assertEquals('http://download.axonivy.com/engine.zip', $releaseInfo->getDownloadUrl());
    }
    
    public function testSortReleaseInfoByVersion()
    {
        $releases[] =  new ReleaseInfo('6.5.2', null);
        $releases[] =  new ReleaseInfo('6.5', null);
        $releases[] =  new ReleaseInfo('6.5.1', null);
        $releases[] =  new ReleaseInfo('6', null);
        $releases[] =  new ReleaseInfo('5.1', null);
        $releases[] =  new ReleaseInfo('6.4.11', null);
        $releases[] =  new ReleaseInfo('5.11', null);
        
        $releases = ReleaseInfo::sortReleaseInfosByVersion($releases);
        
        $this->assertEquals('5.1', $releases[0]->getVersion());
        $this->assertEquals('5.11', $releases[1]->getVersion());
        $this->assertEquals('6', $releases[2]->getVersion());
        $this->assertEquals('6.4.11', $releases[3]->getVersion());
        $this->assertEquals('6.5', $releases[4]->getVersion());
        $this->assertEquals('6.5.1', $releases[5]->getVersion());
        $this->assertEquals('6.5.2', $releases[6]->getVersion());
    }
    
    public function testHasMajorMinorPrefix()
    {
        $releaseInfo = new ReleaseInfo('6.5.1', null);
        
        $this->assertTrue($releaseInfo->hasMajorMinorPrefix('6.5'));
        $this->assertTrue($releaseInfo->hasMajorMinorPrefix('6.5.'));
        $this->assertTrue($releaseInfo->hasMajorMinorPrefix('6.5.5'));
        $this->assertTrue($releaseInfo->hasMajorMinorPrefix('6.5.66'));
        $this->assertTrue($releaseInfo->hasMajorMinorPrefix('6.5.66.5'));
        $this->assertTrue($releaseInfo->hasMajorMinorPrefix('6.5.5.6'));
        $this->assertTrue($releaseInfo->hasMajorMinorPrefix('6.5.5.5ddkk'));
        
        $this->assertFalse($releaseInfo->hasMajorMinorPrefix('6.6'));
        $this->assertFalse($releaseInfo->hasMajorMinorPrefix('6'));
        $this->assertFalse($releaseInfo->hasMajorMinorPrefix('6.'));
        $this->assertFalse($releaseInfo->hasMajorMinorPrefix(''));
        $this->assertFalse($releaseInfo->hasMajorMinorPrefix('  '));
        $this->assertFalse($releaseInfo->hasMajorMinorPrefix(null));
    }
    
    public function testGetMajorMinorPrefix()
    {
        $releaseInfo = new ReleaseInfo('6.5.1', null);
        $this->assertEquals('6.5', $releaseInfo->getMajorMinorPrefix());
        
        $releaseInfo = new ReleaseInfo('5.5.1', null);
        $this->assertEquals('5.5', $releaseInfo->getMajorMinorPrefix());
        
        $releaseInfo = new ReleaseInfo('5.598.1', null);
        $this->assertEquals('5.598', $releaseInfo->getMajorMinorPrefix());
        
        $releaseInfo = new ReleaseInfo('5.5.154.5', null);
        $this->assertEquals('5.5', $releaseInfo->getMajorMinorPrefix());
        
        $releaseInfo = new ReleaseInfo('5.5', null);
        $this->assertEquals('5.5', $releaseInfo->getMajorMinorPrefix());
        
        $releaseInfo = new ReleaseInfo('5.10', null);
        $this->assertEquals('5.10', $releaseInfo->getMajorMinorPrefix());
        
        $releaseInfo = new ReleaseInfo('5.1000', null);
        $this->assertEquals('5.1000', $releaseInfo->getMajorMinorPrefix());
        
        $releaseInfo = new ReleaseInfo('5.', null);
        $this->assertEquals('5', $releaseInfo->getMajorMinorPrefix());
        
        $releaseInfo = new ReleaseInfo('5', null);
        $this->assertEquals('5', $releaseInfo->getMajorMinorPrefix());
        
        $releaseInfo = new ReleaseInfo('555', null);
        $this->assertEquals('555', $releaseInfo->getMajorMinorPrefix());
        
    }
}
