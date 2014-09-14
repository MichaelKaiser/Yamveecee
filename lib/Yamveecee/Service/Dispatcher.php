<?php
namespace Yamveecee\Service;

use Yamveecee\RequestInterface;

/**
 * Class Dispatcher
 * @package Yamveecee\Service
 */
class Dispatcher implements \Yamveecee\ServiceInterface, \Yamveecee\DispatcherInterface
{
    /**
     * @var \Yamveecee\Service\Configuration
     */
    protected $serviceConfig = null;

    /**
     * @param \Yamveecee\Service\Configuration $config
     * @return void
     */
    public function setServiceConfig(\Yamveecee\Service\Configuration $config)
    {
        $this->serviceConfig = $config;
    }

    /**
     * @param RequestInterface $request
     * @return \Yamveecee\ResponseInterface
     */
    public function route(\Yamveecee\RequestInterface $request)
    {
        // TODO: Implement route() method.
    }
}
