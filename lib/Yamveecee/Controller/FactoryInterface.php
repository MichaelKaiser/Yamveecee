<?php
namespace Yamveecee\Controller;

/**
 * Interface FactoryInterface
 * @package Yamveecee\Controller
 */
interface FactoryInterface
{
    /**
     * @param \Yamveecee\Route\RouteInterface $route
     * @return \Yamveecee\Controller\ControllerInterface
     */
    public function makeInstance(\Yamveecee\Route\RouteInterface $route);

    /**
     * @param string $namespace
     * @return void
     */
    public function setControllerNamespace($namespace);
}
