<?php
namespace Yamveecee\Route;

/**
 * Interface RouteInterface
 * @package Yamveecee\Route
 */
interface RouteInterface
{
    /**
     * @param \Yamveecee\RequestInterface $request
     * @return boolean
     */
    public function isMatching(\Yamveecee\RequestInterface $request);

    /**
     * @return string
     */
    public function getControllerName();
}
