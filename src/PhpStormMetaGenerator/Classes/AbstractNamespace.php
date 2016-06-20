<?php
namespace PhpStormMetaGenerator\Classes;


use InvalidArgumentException;
use PhpStormMetaGenerator\Interfaces\InterfaceNamespace;

abstract class AbstractNamespace implements InterfaceNamespace
{

    /** @var string */
    protected $root = '';

    /**
     * AbstractNamespace constructor.
     * @param string $root
     */
    public function __construct($root)
    {
        $this->setRoot($root);
    }

    /**
     * Получить разметку классов пространства имён в виде строки
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
     * Получить путь к корневой директории пространства имён
     *
     * @return string
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Установить путь к корневой директории пространства имён
     *
     * @param string $root
     * @return $this
     */
    public function setRoot($root)
    {
        if (!is_string($root)) {
            throw new InvalidArgumentException('Путь к корневой директории пространства имён должен быть строкой.');
        }

        if (!is_dir($root)) {
            throw new InvalidArgumentException('Путь должен указывать на директорию.');
        }

        $this->root = rtrim($root, DIRECTORY_SEPARATOR);
        return $this;
    }

}