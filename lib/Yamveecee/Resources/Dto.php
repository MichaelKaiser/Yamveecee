<?php
namespace Yamveecee\Resources;

/**
 * Class Dto
 * @package Yamveecee\Resources
 */
class Dto
{
    /**
     * @var string
     */
    protected $path = '';

    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var string
     */
    protected $extension = '';

    /**
     * @param string $path
     * @param string $name
     * @param string $extension
     */
    public function __construct($path, $name, $extension)
    {
        $this->extension = $extension;
        $this->name = $name;
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getFullFileName()
    {
        return $this->getPath() . $this->getName() . $this->getExtension();
    }
}
