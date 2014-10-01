<?php
namespace Yamveecee\Controller;

/**
 * Interface ControllerInterface
 * @package Yamveecee\Controller
 */
interface ControllerInterface
{
    /**
     * @param \Yamveecee\RequestInterface $request
     * @param \Yamveecee\ResponseInterface $response
     * @return \Yamveecee\ResponseInterface
     */
    public function execute(\Yamveecee\RequestInterface $request, \Yamveecee\ResponseInterface $response = null);
}
