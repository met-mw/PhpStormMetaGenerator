<?php
use PhpStormMetaGenerator\Drivers\HostCMS\DriverAdminEntities;
use PhpStormMetaGenerator\Drivers\HostCMS\DriverEntities;
use PhpStormMetaGenerator\MetaGenerator;

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
        $this->assertTrue(empty($metaGenerator->getDrivers()));

        $firstDriver = new DriverEntities($this->entitiesRoot);
        $secondDriver = new DriverAdminEntities($this->adminEntitiesRoot);
        $metaGenerator->addDriver($firstDriver);
        $this->assertEquals(sizeof($metaGenerator->getDrivers()), 1);
        $this->assertSame($metaGenerator->getDrivers()[0], $firstDriver);
        $metaGenerator->addDriver($secondDriver);
        $this->assertEquals(sizeof($metaGenerator->getDrivers()), 2);
        $this->assertSame($metaGenerator->getDrivers()[1], $secondDriver);
    }

}