<?php
use PHPUnit\Framework\TestCase;
use axonivy\update\model\Memory;

final class MemoryTest extends TestCase
{

    public function testGetter()
    {
        $memory = new Memory(55, 66);
        $this->assertEquals(55, $memory->getMaxHeapMemory());
        $this->assertEquals(66, $memory->getMaxNonHeapMemory());
        
        $memory = new Memory('t', 't');
        $this->assertEquals(0, $memory->getMaxHeapMemory());
        $this->assertEquals(0, $memory->getMaxNonHeapMemory());
        
        $memory = new Memory(null, null);
        $this->assertEquals(0, $memory->getMaxHeapMemory());
        $this->assertEquals(0, $memory->getMaxNonHeapMemory());
    }
}
