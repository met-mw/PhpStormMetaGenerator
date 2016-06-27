<?php
namespace PhpStormMetaGenerator;
use PhpStormMetaGenerator\Drivers\DriverInterface;


/**
 * Meta generator interface
 *
 * Interface MetaGeneratorInterface
 * @package PhpStormMetaGenerator
 */
interface MetaGeneratorInterface
{

    /**
     * Add driver
     *
     * @param DriverInterface $driver
     * @return $this
     */
    public function addDriver(DriverInterface $driver);

    /**
     * Get meta as string
     *
     * @return string
     */
    public function get();

    /**
     * Get added drivers
     *
     * @return DriverInterface[]
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