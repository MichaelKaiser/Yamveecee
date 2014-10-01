<?php
namespace Yamveecee\Route;

/**
 * Interface FactoryInterface
 * @package Yamveecee\Route
 */
interface FactoryInterface
{
    /**
     * @param $routeName
     * @param \stdClass $config
     * @return \Yamveecee\Route\RouteInterface
     */
    public function makeInstance($routeName, \stdClass $config);
}
