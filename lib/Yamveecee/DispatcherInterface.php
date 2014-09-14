<?php
namespace Yamveecee;

/**
 * Interface DispatcherInterface
 * @package Yamveecee
 */
interface DispatcherInterface
{
    /**
     * @param RequestInterface $request
     * @return \Yamveecee\ResponseInterface
     */
    public function route(\Yamveecee\RequestInterface $request);
}
