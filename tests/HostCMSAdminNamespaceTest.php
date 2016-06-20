<?php
use PhpStormMetaGenerator\Classes\HostCMS\AdminEntitiesNamespace;

class HostCMSAdminNamespaceTest extends PHPUnit_Framework_TestCase
{

    private $root = __DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'hostcms' . DIRECTORY_SEPARATOR . 'adminentities';

    public function testSets()
    {
        $namespace = new AdminEntitiesNamespace($this->root);
        $this->assertSame($namespace->setRoot($this->root), $namespace);
    }

    public function testScan()
    {
        $namespace = new AdminEntitiesNamespace($this->root);

        $this->assertSame($namespace->scan(), $namespace);
        $this->assertEquals($namespace->getClasses(), ['Admin_Form_Entity_Test1', 'Admin_Form_Entity_Test2']);
    }

}