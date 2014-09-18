<?php
namespace Yamveecee\Service;

use Yamveecee\Config\ConfigInterface;
use Yamveecee\RequestInterface;

/**
 * Class Dispatcher
 * @package Yamveecee\Service
 */
class Dispatcher implements \Yamveecee\ServiceInterface, \Yamveecee\DispatcherInterface
{
    /**
     * @var ConfigInterface
     */
    protected $serviceConfig = null;

    /**
     * @param ConfigInterface $config
     * @return void
     */
    public function setServiceConfig(\Yamveecee\Config\ConfigInterface $config)
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
