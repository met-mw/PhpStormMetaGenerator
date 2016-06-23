<?php
namespace PhpStormMetaGenerator\Interfaces;


/**
 * Driver interface
 *
 * Interface InterfaceDriver
 * @package PhpStormMetaGenerator\Interfaces
 */
interface InterfaceDriver
{

    /**
     * Get generated meta as string
     *
     * @return string
     */
    public function get();

    /**
     * Get driver root path
     *
     * @return string
     */
    public function getRoot();

    /**
     * Get founded classes
     *
     * @return string[]
     */
    public function getClasses();

    /**
     * Scan driver root directory to find classes
     *
     * @param string|null $directoryPath Scanned directory path (need for recursive scan)
     * @return $this
     */
    public function scan($directoryPath = null);

    /**
     * Set driver root path
     *
     * @param string $root
     * @return $this
     */
    public function setRoot($root);

    /**
     * Render driver meta
     *
     * @return void
     */
    public function render();

}