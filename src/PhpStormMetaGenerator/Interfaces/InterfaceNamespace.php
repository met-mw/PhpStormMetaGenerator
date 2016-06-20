<?php
namespace PhpStormMetaGenerator\Interfaces;


/**
 * Интерфейс пространства имён
 *
 * Interface InterfaceMetaNamespace
 * @package PhpStormMetaGenerator\Interfaces
 */
interface InterfaceNamespace
{

    /**
     * Получить разметку классов пространства имён в виде строки
     *
     * @return string
     */
    public function get();

    /**
     * Получить путь к корневой директории пространства имён
     *
     * @return string
     */
    public function getRoot();

    /**
     * Получить все найнеднные классы в заданном пространстве имён
     *
     * @return string[]
     */
    public function getClasses();

    /**
     * Сканировать заданную директорию на предмет удовлетворябщих шаблону файлов
     *
     * @param string|null $directoryPath Путь к сканируемой директории
     * @return $this
     */
    public function scan($directoryPath = null);

    /**
     * Установить путь к корневой директории пространства имён
     *
     * @param string $root
     * @return $this
     */
    public function setRoot($root);

    /**
     * Вывести разметку классов пространства имён
     *
     * @return void
     */
    public function render();

}