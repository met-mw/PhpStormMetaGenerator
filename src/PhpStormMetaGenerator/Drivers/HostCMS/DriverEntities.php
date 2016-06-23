<?php
namespace PhpStormMetaGenerator\Drivers\HostCMS;


use InvalidArgumentException;
use PhpStormMetaGenerator\DriverAbstract;
use PhpStormMetaGenerator\Interfaces\DriverInterface;

/**
 * Driver for HostCMS to search entities classes.
 *
 * Class DriverEntities
 * @package PhpStormMetaGenerator\Drivers\HostCMS
 */
class DriverEntities extends DriverAbstract implements DriverInterface
{

    /** Model-file name */
    const SEARCH_FILE_NAME = 'model.php';

    /** @var string[] Founded classes list */
    protected $classes = [];

    /**
     * Get the entity's class by file path
     *
     * @param string $path Path to model-file
     * @return string
     */
    protected function getFileNameByPath($path)
    {
        if (!file_exists($path) || !is_file($path)) {
            throw new InvalidArgumentException('Path must be a file-path.');
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
     * Get founded classes
     *
     * @return string[]
     */
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * Scan driver root directory to find classes
     *
     * @param string|null $directoryPath Scanned directory path (need for recursive scan)
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

            $this->classes[] = $this->getFileNameByPath($currentElementPath);
        }

        return $this;
    }

    /**
     * Render driver meta
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