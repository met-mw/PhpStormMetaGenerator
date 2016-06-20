<?php
use PhpStormMetaGenerator\Classes\HostCMS\AdminEntitiesNamespace;
use PhpStormMetaGenerator\Classes\HostCMS\EntitiesNamespace;
use PhpStormMetaGenerator\Classes\MetaGenerator;

class MetaGeneratorTest extends PHPUnit_Framework_TestCase
{

    private $metaFilePath = __DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . '.phpstorm.meta.php';
    private $entitiesRoot = __DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'hostcms' . DIRECTORY_SEPARATOR . 'modules';
    private $adminEntitiesRoot = __DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'hostcms' . DIRECTORY_SEPARATOR . 'adminentities';

    public function testSets()
    {
        $metaGenerator = new MetaGenerator($this->metaFilePath);
        $this->assertSame($metaGenerator->setMetaFilePath($this->metaFilePath), $metaGenerator);
    }

    public function testMetaFilePath()
    {
        $metaGenerator = new MetaGenerator('path1');
        $this->assertEquals($metaGenerator->getMetaFilePath(), 'path1');
        $metaGenerator->setMetaFilePath('path2');
        $this->assertEquals($metaGenerator->getMetaFilePath(), 'path2');
    }

    public function testNamespaces()
    {
        $metaGenerator = new MetaGenerator($this->metaFilePath);
        $this->assertTrue(empty($metaGenerator->getNamespaces()));

        $firstNamespace = new EntitiesNamespace($this->entitiesRoot);
        $secondNamespace = new AdminEntitiesNamespace($this->adminEntitiesRoot);
        $metaGenerator->addNamespace($firstNamespace);
        $this->assertEquals(sizeof($metaGenerator->getNamespaces()), 1);
        $this->assertSame($metaGenerator->getNamespaces()[0], $firstNamespace);
        $metaGenerator->addNamespace($secondNamespace);
        $this->assertEquals(sizeof($metaGenerator->getNamespaces()), 2);
        $this->assertSame($metaGenerator->getNamespaces()[1], $secondNamespace);
    }

}