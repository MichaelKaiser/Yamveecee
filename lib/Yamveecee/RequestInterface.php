<?php
namespace Yamveecee;

/**
 * Interface RequestInterface
 * @package Yamveecee
 */
interface RequestInterface
{
    /**
     * @return string
     * @todo: make more generic
     */
    public function getUri();

    /**
     * @param Route\RouteInterface $route
     * @return void
     */
    public function setRoute(\Yamveecee\Route\RouteInterface $route);

    /**
     * @return \Yamveecee\Route\RouteInterface
     */
    public function getRoute();
}
