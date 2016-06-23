<?php
/**
 * Using the library as an example HostCMS
 */
require_once('../../src/PhpStormMetaGenerator/Interfaces/DriverInterface.php');
require_once('../../src/PhpStormMetaGenerator/Interfaces/MetaGeneratorInterface.php');
require_once('../../src/PhpStormMetaGenerator/DriverAbstract.php');
require_once('../../src/PhpStormMetaGenerator/MetaGenerator.php');
require_once('../../src/PhpStormMetaGenerator/Drivers/HostCMS/DriverEntities.php');
require_once('../../src/PhpStormMetaGenerator/Drivers/HostCMS/DriverAdminEntities.php');

use PhpStormMetaGenerator\Drivers\HostCMS\DriverAdminEntities;
use PhpStormMetaGenerator\Drivers\HostCMS\DriverEntities;
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
$metaGenerator->addDriver(new DriverEntities($entitiesPath)) // Add entities driver
    ->addDriver(new DriverAdminEntities($adminEntitiesPath)) // Add admin-entities driver
    ->scan()
    ->printFile();