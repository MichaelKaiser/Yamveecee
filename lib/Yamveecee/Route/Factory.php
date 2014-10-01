<?php
namespace Yamveecee\Route;

/**
 * Class Factory
 * @package Yamveecee\Route
 */
class Factory implements FactoryInterface
{

    /**
     * @param $routeName
     * @param \stdClass $config
     * @return \Yamveecee\Route\RouteInterface
     */
    public function makeInstance($routeName, \stdClass $config)
    {
        return new \Yamveecee\Route\Route($routeName, $config);
    }
}
