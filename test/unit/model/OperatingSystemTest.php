<?php
use PHPUnit\Framework\TestCase;
use axonivy\update\model\OperatingSystem;

final class OperatingSystemTest extends TestCase
{
    private $testee;
    
    public function setUp(): void
    {
        $this->testee = new OperatingSystem('arch', 'linuxfriz', '45', 10);
    }
    
    
    public function testGetArchitecture()
    {
        $this->assertEquals('arch', $this->testee->getArchitecture());
    }
    
    public function testGetName()
    {
        $this->assertEquals('linuxfriz', $this->testee->getName());
    }
    
    public function testGetVersion()
    {
        $this->assertEquals('45', $this->testee->getVersion());
    }
    
    public function testGetProcessors()
    {
        $this->assertEquals(10, $this->testee->getAvailableProcessors());
    }
    
    public function testGetProcessors_stringAsInput()
    {
        $os = new OperatingSystem(null, null, null, '8');
        $this->assertEquals(8, $os->getAvailableProcessors());
    }
}
