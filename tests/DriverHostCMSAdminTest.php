<?php
use PhpStormMetaGenerator\Drivers\HostCMS\DriverAdminEntities;

class DriverHostCMSAdminTest extends PHPUnit_Framework_TestCase
{

    private $root = __DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'hostcms' . DIRECTORY_SEPARATOR . 'adminentities';

    public function testSets()
    {
        $driver = new DriverAdminEntities($this->root);
        $this->assertSame($driver->setRoot($this->root), $driver);
    }

    public function testScan()
    {
        $driver = new DriverAdminEntities($this->root);

        $this->assertSame($driver->scan(), $driver);
        $this->assertEquals($driver->getClasses(), ['Admin_Form_Entity_Test1', 'Admin_Form_Entity_Test2']);
    }

}