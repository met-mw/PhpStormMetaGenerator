<?php
namespace PhpStormMetaGenerator\Classes\HostCMS;


use PhpStormMetaGenerator\Classes\AbstractNamespace;
use PhpStormMetaGenerator\Interfaces\InterfaceNamespace;

class AdminEntitiesNamespace extends AbstractNamespace implements InterfaceNamespace
{

    const PREFIX = 'Admin_Form_Entity_';

    /** @var string[] */
    protected $classes = [];

    /**
     * Получить все найнеднные классы в заданном пространстве имён
     *
     * @return string[]
     */
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * Сканировать заданную директорию на предмет удовлетворябщих шаблону файлов
     *
     * @param string|null $directoryPath Путь к сканируемой директории
     * @return $this
     */
    public function scan($directoryPath = null)
    {
        $scannedElements = scandir(is_null($directoryPath) ? $this->getRoot() : $directoryPath);
        $scannedElements = array_diff($scannedElements, ['.', '..']);
        foreach ($scannedElements as $element) {
            $currentElementPath = $directoryPath . DIRECTORY_SEPARATOR . $element;
            if (is_dir($currentElementPath)) {
                $this->scan($currentElementPath);
                continue;
            }

            $this->classes[] = self::PREFIX . ucfirst(substr($element, 0, strlen($element) - strlen('.php')));
        }

        return $this;
    }

    /**
     * Вывести разметку классов пространства имён
     *
     * @return void
     */
    public function render()
    {
        echo '      \Admin_Form_Entity::factory(\'\') => array(', PHP_EOL;
        foreach ($this->getClasses() as $class) {
            echo '          \'', substr($class, strlen(self::PREFIX)), '\' instanceof \\', $class, ',', PHP_EOL;
        }
        echo '      ),' . PHP_EOL;
    }

}