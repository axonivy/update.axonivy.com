<?php
use PHPUnit\Framework\TestCase;
use axonivy\update\model\Designer;

final class DesignerTest extends TestCase
{

    public function testVersion()
    {
        $designer = new Designer('6.5');
        $this->assertEquals('6.5', $designer->getVersion());
    }
}
