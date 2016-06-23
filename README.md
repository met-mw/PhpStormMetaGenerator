[![Build Status](https://travis-ci.org/met-mw/PhpStormMetaGenerator.svg?branch=master)](https://travis-ci.org/met-mw/PhpStormMetaGenerator)
[![Coverage Status](https://coveralls.io/repos/github/met-mw/PhpStormMetaGenerator/badge.svg?branch=master)](https://coveralls.io/github/met-mw/PhpStormMetaGenerator?branch=master)
[![Latest Stable Version](https://poser.pugx.org/met_mw/phpstormmetagenerator/v/stable)](https://packagist.org/packages/met_mw/phpstormmetagenerator)
[![Total Downloads](https://poser.pugx.org/met_mw/phpstormmetagenerator/downloads)](https://packagist.org/packages/met_mw/phpstormmetagenerator)
[![Latest Unstable Version](https://poser.pugx.org/met_mw/phpstormmetagenerator/v/unstable)](https://packagist.org/packages/met_mw/phpstormmetagenerator)
[![License](https://poser.pugx.org/met_mw/phpstormmetagenerator/license)](https://packagist.org/packages/met_mw/phpstormmetagenerator)
# PhpStorm meta-file generator (.phpstorm.meta.php).

## Install
```
composer require met_mw/phpstormmetagenerator
```

## Example
See the folder "example" at package's root.

```
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
$metaGenerator->addDriver(new DriverEntities($entitiesPath)) // Add entities driver
    ->addDriver(new DriverAdminEntities($adminEntitiesPath)) // Add admin-entities driver
    ->scan()
    ->printFile();
```

## License
The met-mw/PhpStormMetaGenerator package is open-sourced software licensed under the **[MIT license](https://opensource.org/licenses/MIT)**