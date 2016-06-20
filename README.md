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