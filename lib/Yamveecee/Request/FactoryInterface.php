<?php
namespace Yamveecee\Request;

/**
 * Interface FactoryInterface
 * @package Yamveecee\Request
 */
interface FactoryInterface
{
    /**
     * @return \Yamveecee\RequestInterface
     */
    public function getRequest();
}
