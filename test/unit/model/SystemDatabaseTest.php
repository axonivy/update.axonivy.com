<?php
use PHPUnit\Framework\TestCase;
use axonivy\update\model\SystemDatabase;

final class SystemDatabaseTest extends TestCase
{

    public function testGetter()
    {
        $sytemDatabase = new SystemDatabase(5, 'driver', 'productName', 'productVersion');
        
        $this->assertEquals(5, $sytemDatabase->getId());
        $this->assertEquals('driver', $sytemDatabase->getDriver());
        $this->assertEquals('productName', $sytemDatabase->getProductName());
        $this->assertEquals('productVersion', $sytemDatabase->getProductVersion());
    }
}
