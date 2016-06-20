<?php
namespace PhpStormMetaGenerator\Interfaces;


interface InterfaceMetaGenerator
{

    /**
     * Добавить пространство имён
     *
     * @param InterfaceNamespace $namespace
     * @return $this
     */
    public function addNamespace(InterfaceNamespace $namespace);

    /**
     * Получить содержимое мета-файла в виде строки
     *
     * @return string
     */
    public function get();

    /**
     * @return string
     */
    public function getMetaFilePath();

    /**
     * Получить массив пространств имён
     *
     * @return InterfaceNamespace[]
     */
    public function getNamespaces();

    /**
     * Записать содержимое в файл
     *
     * @return $this
     */
    public function printFile();

    /**
     * Вывести содержимое мета-файла
     *
     * @return $this
     */
    public function render();

    /**
     * Установить путь к мета-файлу
     *
     * @param string $metaFilePath
     * @return $this
     */
    public function setMetaFilePath($metaFilePath);

    /**
     * Сканировать все установленные пространства имён
     *
     * @return $this
     */
    public function scan();

}