<?php
namespace Yamveecee\Resources;

/**
 * Class IllegalPathException
 * @package Yamveecee\Resources
 */
class IllegalPathException extends \Exception
{
    /**
     * @var string
     */
    protected $path = '';

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
}
