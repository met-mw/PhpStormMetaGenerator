[![Build Status](https://travis-ci.org/met-mw/PhpStormMetaGenerator.svg?branch=master)](https://travis-ci.org/met-mw/PhpStormMetaGenerator)
[![Coverage Status](https://coveralls.io/repos/github/met-mw/PhpStormMetaGenerator/badge.svg?branch=master)](https://coveralls.io/github/met-mw/PhpStormMetaGenerator?branch=master)
[![Latest Stable Version](https://poser.pugx.org/met_mw/phpstormmetagenerator/v/stable)](https://packagist.org/packages/met_mw/phpstormmetagenerator)
[![Total Downloads](https://poser.pugx.org/met_mw/phpstormmetagenerator/downloads)](https://packagist.org/packages/met_mw/phpstormmetagenerator)
[![Latest Unstable Version](https://poser.pugx.org/met_mw/phpstormmetagenerator/v/unstable)](https://packagist.org/packages/met_mw/phpstormmetagenerator)
[![License](https://poser.pugx.org/met_mw/phpstormmetagenerator/license)](https://packagist.org/packages/met_mw/phpstormmetagenerator)
# Генератор phpStorm-метафайла для фабрик объектов.

## Установка

```
composer require mediartis/phpstormmetagenerator
```

## Пример использования
Создаём файл со следующим кодом и запускаем его

### HostCMS

```
use PhpStormMetaGenerator\Classes\HostCMS\AdminEntitiesNamespace;
use PhpStormMetaGenerator\Classes\HostCMS\EntitiesNamespace;
use PhpStormMetaGenerator\Classes\MetaGenerator;

// Путь к создаваемому мета-файлу
$phpStormMetaFilePath = CMS_FOLDER . '.phpstorm.meta.php';
// Путь к директории, содержащей ORM-сущности
$entitiesPath = CMS_FOLDER . 'modules';
// Путь к директории, содержащей специальные сущности панели администратора  
$adminEntitiesPath = CMS_FOLDER . 'modules' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'form' . DIRECTORY_SEPARATOR . 'entity';

$metaGenerator = new MetaGenerator($phpStormMetaFilePath);
$metaGenerator->addNamespace(new EntitiesNamespace($entitiesPath)) // Добавляем пространство имён ORM-сущностей
    ->addNamespace(new AdminEntitiesNamespace($adminEntitiesPath)) // Добавляем пространство имён сущностей панели администратора
    ->scan() // Сканируем добавленные пространства имён
    ->printFile(); // Пишем сгенерированные мета-данные в файл
```