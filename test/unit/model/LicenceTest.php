<?php
use PHPUnit\Framework\TestCase;
use axonivy\update\model\Licence;

final class LicenceTest extends TestCase
{

    public function testGetter()
    {
        $licence = new Licence('id', 'individual', 'organisation');
        
        $this->assertEquals('id', $licence->getId());
        $this->assertEquals('individual', $licence->getIndividual());
        $this->assertEquals('organisation', $licence->getOrganisation());
    }
}
