<?php
/**
 * Using the library as an example HostCMS
 */
require_once('../../src/PhpStormMetaGenerator/Interfaces/InterfaceDriver.php');
require_once('../../src/PhpStormMetaGenerator/Interfaces/InterfaceMetaGenerator.php');
require_once('../../src/PhpStormMetaGenerator/AbstractDriver.php');
require_once('../../src/PhpStormMetaGenerator/MetaGenerator.php');
require_once('../../src/PhpStormMetaGenerator/Drivers/HostCMS/EntitiesDriver.php');
require_once('../../src/PhpStormMetaGenerator/Drivers/HostCMS/AdminEntitiesDriver.php');

use PhpStormMetaGenerator\Drivers\HostCMS\AdminEntitiesDriver;
use PhpStormMetaGenerator\Drivers\HostCMS\EntitiesDriver;
use PhpStormMetaGenerator\MetaGenerator;

// Replace it by project root path
const CMS_FOLDER = '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR
    . 'tests' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'hostcms' . DIRECTORY_SEPARATOR;

// Meta-file path
$phpStormMetaFilePath = CMS_FOLDER . '.phpstorm.meta.php';
// Modules directory path
$entitiesPath = CMS_FOLDER . 'modules';
// Administrator's area classes directory path
$adminEntitiesPath = CMS_FOLDER . 'adminentities';

$metaGenerator = new MetaGenerator($phpStormMetaFilePath);
$metaGenerator->addDriver(new EntitiesDriver($entitiesPath)) // Add entities driver
    ->addDriver(new AdminEntitiesDriver($adminEntitiesPath)) // Add admin-entities driver
    ->scan()
    ->printFile();