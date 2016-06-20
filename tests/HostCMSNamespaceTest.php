<?php
use PhpStormMetaGenerator\Classes\HostCMS\EntitiesNamespace;

class HostCMSNamespaceTest extends PHPUnit_Framework_TestCase
{

    private $root = __DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'hostcms' . DIRECTORY_SEPARATOR . 'modules';

    public function testSets()
    {
        $namespace = new EntitiesNamespace($this->root);
        $this->assertSame($namespace->setRoot($this->root), $namespace);
    }

    public function testScan()
    {
        $namespace = new EntitiesNamespace($this->root);

        $this->assertSame($namespace->scan(), $namespace);
        $this->assertEquals($namespace->getClasses(), ['Module1_Model', 'Module1_Module1sub_Model']);
    }

}