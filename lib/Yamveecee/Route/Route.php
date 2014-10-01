<?php
namespace Yamveecee\Route;

/**
 * Class Route
 * @package Yamveecee\Route
 */
class Route implements \Yamveecee\Route\RouteInterface
{
    /**
     * @var string
     */
    protected $routeName = '';

    /**
     * @var \stdClass
     */
    protected $routeConfig;

    /**
     * @param string $routeName
     * @param \stdClass $routeConfig
     */
    public function __construct($routeName, \stdClass $routeConfig)
    {
        $this->routeName = $routeName;
        $this->routeConfig = $routeConfig;
    }

    /**
     * @param \Yamveecee\RequestInterface $request
     * @return boolean
     */
    public function isMatching(\Yamveecee\RequestInterface $request)
    {
        // TODO: Implement isMatching() method.
    }

    /**
     * @return string
     */
    public function getControllerName()
    {
        // TODO: Implement getControllerName() method.
    }
}
