<?php
namespace PhpStormMetaGenerator;


use InvalidArgumentException;
use PhpStormMetaGenerator\Interfaces\DriverInterface;

/**
 * Abstract driver class
 * (Extend this to develop any drivers)
 *
 * Class DriverAbstract
 * @package PhpStormMetaGenerator
 */
abstract class DriverAbstract implements DriverInterface
{

    /** @var string Driver root path */
    protected $root = '';

    /**
     * AbstractNamespace constructor.
     * @param string $root Driver root path
     */
    public function __construct($root)
    {
        $this->setRoot($root);
    }

    /**
     * Get generated meta as string
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
     * Get driver root path
     *
     * @return string
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Set driver root path
     *
     * @param string $root
     * @return $this
     */
    public function setRoot($root)
    {
        if (!is_string($root)) {
            throw new InvalidArgumentException('Root path must be a string.');
        }

        if (!is_dir($root)) {
            throw new InvalidArgumentException('Root must be a directory.');
        }

        $this->root = rtrim($root, DIRECTORY_SEPARATOR);
        return $this;
    }

}