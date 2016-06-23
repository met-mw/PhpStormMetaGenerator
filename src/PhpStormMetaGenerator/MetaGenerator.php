<?php
namespace PhpStormMetaGenerator;


use InvalidArgumentException;
use PhpStormMetaGenerator\Interfaces\InterfaceMetaGenerator;
use PhpStormMetaGenerator\Interfaces\InterfaceDriver;

/**
 * PhpStorm meta-file generator.
 * Creates ".phpstorm.meta.php" file
 *
 * Class MetaGenerator
 * @package PhpStormMetaGenerator
 */
class MetaGenerator implements InterfaceMetaGenerator
{

    /** @var string */
    protected $metaFilePath;
    /** @var InterfaceDriver[] */
    protected $drivers;

    /**
     * MetaGenerator constructor.
     * @param string $metaFilePath
     */
    public function __construct($metaFilePath)
    {
        $this->setMetaFilePath($metaFilePath);
    }

    /**
     * Add driver
     *
     * @param InterfaceDriver $driver
     * @return $this
     */
    public function addDriver(InterfaceDriver $driver)
    {
        $this->drivers[] = $driver;
        return $this;
    }

    /**
     * Get meta as string
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
     * Get added drivers
     *
     * @return InterfaceDriver[]
     */
    public function getDrivers()
    {
        return $this->drivers;
    }

    /**
     * Get meta-file path
     *
     * @return string
     */
    public function getMetaFilePath()
    {
        return $this->metaFilePath;
    }

    /**
     * Print meta to file
     *
     * @return $this
     */
    public function printFile()
    {
        file_put_contents($this->getMetaFilePath(), $this->get());
    }

    /**
     * Render meta
     *
     * @return $this
     */
    public function render()
    {
        echo '<?php', PHP_EOL, 'namespace PHPSTORM_META {', PHP_EOL, PHP_EOL,
            '   /** @noinspection PhpUnusedLocalVariableInspection */', PHP_EOL,
            '   /** @noinspection PhpIllegalArrayKeyTypeInspection */', PHP_EOL, PHP_EOL,
            '   $STATIC_METHOD_TYPES = array(', PHP_EOL;

        foreach ($this->getDrivers() as $namespace) {
            $namespace->render();
        }

        echo '  );', PHP_EOL, '}';
    }

    /**
     * Set meta-file path
     *
     * @param string $metaFilePath Meta-file path
     * @return $this
     */
    public function setMetaFilePath($metaFilePath)
    {
        $dirName = dirname($metaFilePath);
        if (!file_exists($dirName) || !is_dir($dirName)) {
            throw new InvalidArgumentException('Invalid file path.');
        }

        $this->metaFilePath = $metaFilePath;
        return $this;
    }

    /**
     * Scan project
     *
     * @return $this
     */
    public function scan()
    {
        foreach ($this->getDrivers() as $driver) {
            $driver->scan();
        }

        return $this;
    }

}