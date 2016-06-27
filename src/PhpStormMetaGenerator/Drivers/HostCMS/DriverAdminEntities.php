<?php
namespace PhpStormMetaGenerator\Drivers\HostCMS;


use PhpStormMetaGenerator\Drivers\DriverAbstract;
use PhpStormMetaGenerator\Drivers\DriverInterface;


/**
 * Driver for HostCMS to search classes at administrator's area.
 *
 * Class DriverAdminEntities
 * @package PhpStormMetaGenerator\Drivers\HostCMS
 */
class DriverAdminEntities extends DriverAbstract implements DriverInterface
{

    /** Administrator's area classes name prefix */
    const PREFIX = 'Admin_Form_Entity_';

    /** @var string[] Founded classes list */
    protected $classes = [];

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
        $scannedElements = scandir(is_null($directoryPath) ? $this->getRoot() : $directoryPath);
        $scannedElements = array_diff($scannedElements, ['.', '..']);
        foreach ($scannedElements as $element) {
            $currentElementPath = $directoryPath . DIRECTORY_SEPARATOR . $element;
            if (is_dir($currentElementPath)) {
                $this->scan($currentElementPath);
                continue;
            }

            $this->classes[] = self::PREFIX . ucfirst(substr($element, 0, strlen($element) - strlen('.php')));
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
        echo '      \Admin_Form_Entity::factory(\'\') => array(', PHP_EOL;
        foreach ($this->getClasses() as $class) {
            echo '          \'', substr($class, strlen(self::PREFIX)), '\' instanceof \\', $class, ',', PHP_EOL;
        }
        echo '      ),' . PHP_EOL;
    }

}