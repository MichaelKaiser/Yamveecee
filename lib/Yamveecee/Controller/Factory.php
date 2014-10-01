<?php
namespace Yamveecee\Controller;

/**
 * Class Factory
 * @package Yamveecee\Controller
 */
class Factory implements FactoryInterface
{
    /**
     * @var string
     */
    protected $namespace = '';

    /**
     * @param \Yamveecee\Route\RouteInterface $route
     * @return \Yamveecee\Controller\ControllerInterface
     */
    public function makeInstance(\Yamveecee\Route\RouteInterface $route)
    {
        $className = $this->namespace . $route->getControllerName();
        return new $className;
    }

    /**
     * @param string $namespace
     * @return void
     */
    public function setControllerNamespace($namespace)
    {
        $this->namespace = $namespace;
    }
}
