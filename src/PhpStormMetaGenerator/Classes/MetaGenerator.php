<?php
namespace PhpStormMetaGenerator\Classes;


use InvalidArgumentException;
use PhpStormMetaGenerator\Interfaces\InterfaceMetaGenerator;
use PhpStormMetaGenerator\Interfaces\InterfaceNamespace;

class MetaGenerator implements InterfaceMetaGenerator
{

    /** @var string */
    protected $metaFilePath;
    /** @var InterfaceNamespace[] */
    protected $namespaces;

    /**
     * MetaGenerator constructor.
     * @param string $metaFilePath
     */
    public function __construct($metaFilePath)
    {
        $this->setMetaFilePath($metaFilePath);
    }

    /**
     * Добавить пространство имён
     *
     * @param InterfaceNamespace $namespace
     * @return $this
     */
    public function addNamespace(InterfaceNamespace $namespace)
    {
        $this->namespaces[] = $namespace;
        return $this;
    }

    /**
     * Получить содержимое мета-файла в виде строки
     *
     * @return string
     */
    public function get()
    {
        ob_start();
        $this->render();
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    /**
     * Получить массив пространств имён
     *
     * @return InterfaceNamespace[]
     */
    public function getNamespaces()
    {
        return $this->namespaces;
    }

    /**
     * @return string
     */
    public function getMetaFilePath()
    {
        return $this->metaFilePath;
    }

    /**
     * Записать содержимое в файл
     *
     * @return $this
     */
    public function printFile()
    {
        file_put_contents($this->getMetaFilePath(), $this->get());
    }

    /**
     * Вывести содержимое мета-файла
     *
     * @return $this
     */
    public function render()
    {
        echo '<?php', PHP_EOL, 'namespace PHPSTORM_META {', PHP_EOL, PHP_EOL,
            '   /** @noinspection PhpUnusedLocalVariableInspection */', PHP_EOL,
            '   /** @noinspection PhpIllegalArrayKeyTypeInspection */', PHP_EOL, PHP_EOL,
            '   $STATIC_METHOD_TYPES = array(', PHP_EOL;

        foreach ($this->getNamespaces() as $namespace) {
            $namespace->render();
        }

        echo '  );', PHP_EOL, '}';
    }

    /**
     * Установить путь к мета-файлу
     *
     * @param string $metaFilePath
     * @return $this
     */
    public function setMetaFilePath($metaFilePath)
    {
        $dirName = dirname($metaFilePath);
        if (!file_exists($dirName) || !is_dir($dirName)) {
            throw new InvalidArgumentException('Некорректный путь к файлу.');
        }

        $this->metaFilePath = $metaFilePath;
        return $this;
    }

    /**
     * Сканировать все установленные пространства имён
     *
     * @return $this
     */
    public function scan()
    {
        foreach ($this->getNamespaces() as $namespace) {
            $namespace->scan();
        }

        return $this;
    }

}