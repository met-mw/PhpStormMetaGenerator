<?php
namespace PhpStormMetaGenerator\Interfaces;


interface InterfaceMetaGenerator
{

    /**
     * Add driver
     *
     * @param InterfaceDriver $driver
     * @return $this
     */
    public function addDriver(InterfaceDriver $driver);

    /**
     * Get meta as string
     *
     * @return string
     */
    public function get();

    /**
     * Get added drivers
     *
     * @return InterfaceDriver[]
     */
    public function getDrivers();

    /**
     * Get meta-file path
     *
     * @return string
     */
    public function getMetaFilePath();

    /**
     * Print meta to file
     *
     * @return $this
     */
    public function printFile();

    /**
     * Render meta
     *
     * @return $this
     */
    public function render();

    /**
     * Set meta-file path
     *
     * @param string $metaFilePath Meta-file path
     * @return $this
     */
    public function setMetaFilePath($metaFilePath);

    /**
     * Scan project
     *
     * @return $this
     */
    public function scan();

}