<?php
namespace Yamveecee\Controller;

/**
 * Class NoControllerException
 * @package Yamveecee\Controller
 */
class NoControllerException extends \Exception
{
    /**
     * @var string
     */
    protected $uri = '';

    /**
     * @param string $uri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }
}
