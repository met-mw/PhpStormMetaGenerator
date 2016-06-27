<?php
use PhpStormMetaGenerator\Drivers\HostCMS\DriverEntities;

class DriverHostCMSTest extends PHPUnit_Framework_TestCase
{

    private $root = __DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'hostcms' . DIRECTORY_SEPARATOR . 'modules';

    public function testSets()
    {
        $driver = new DriverEntities($this->root);
        $this->assertSame($driver->setRoot($this->root), $driver);
    }

    public function testScan()
    {
        $driver = new DriverEntities($this->root);

        $this->assertSame($driver->scan(), $driver);
        $this->assertEquals($driver->getClasses(), ['Module1_Model', 'Module1_Module1sub_Model']);
    }

}