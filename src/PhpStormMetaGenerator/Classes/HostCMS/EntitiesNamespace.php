<?php
namespace PhpStormMetaGenerator\Classes\HostCMS;


use InvalidArgumentException;
use PhpStormMetaGenerator\Classes\AbstractNamespace;
use PhpStormMetaGenerator\Interfaces\InterfaceNamespace;

class EntitiesNamespace extends AbstractNamespace implements InterfaceNamespace
{

    const SEARCH_FILE_NAME = 'model.php';

    /** @var string[] */
    protected $classes = [];

    protected function calcClassNameByFilePath($path)
    {
        if (!file_exists($path) || !is_file($path)) {
            throw new InvalidArgumentException('Должен быть указан путь к файлу.');
        }

        $classNameFragments = ['Model'];
        $path = substr($path, 0, strlen($path) - strlen(DIRECTORY_SEPARATOR . self::SEARCH_FILE_NAME));
        while ($this->getRoot() != $path) {
            $fragment = basename($path);
            $path = substr($path, 0, strlen($path) - strlen(DIRECTORY_SEPARATOR . $fragment));
            $classNameFragments[] = ucfirst($fragment);
        }

        return implode('_', array_reverse($classNameFragments));
    }

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
        $directoryPath = is_null($directoryPath) ? $this->getRoot() : $directoryPath;
        $scannedElements = scandir($directoryPath);
        $scannedElements = array_diff($scannedElements, ['.', '..']);
        foreach ($scannedElements as $element) {
            $currentElementPath = $directoryPath . DIRECTORY_SEPARATOR . $element;
            if (is_dir($currentElementPath)) {
                $this->scan($currentElementPath);
                continue;
            } elseif ($element != self::SEARCH_FILE_NAME) {
                continue;
            }

            $this->classes[] = $this->calcClassNameByFilePath($currentElementPath);
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
        echo '      \\Core_ORM::factory(\'\') => array(', PHP_EOL;
        foreach ($this->getClasses() as $class) {
            echo '          \'', substr($class, 0, strlen($class) - strlen('_Model')), '\' instanceof \\', $class, ',', PHP_EOL;
        }
        echo '      ),' . PHP_EOL;
    }

}