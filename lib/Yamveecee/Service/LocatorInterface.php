<?php
namespace Yamveecee\Service;

/**
 * Interface LocatorInterface
 * @package Yamveecee\Service
 */
interface LocatorInterface extends \Yamveecee\ServiceInterface
{
    /**
     * @param string $serviceName
     * @param \Yamveecee\ServiceInterface $service
     * @return void
     */
    public function addService($serviceName, \Yamveecee\ServiceInterface $service);

    /**
     * @return \Yamveecee\DispatcherInterface
     */
    public function getDispatcher();

    /**
     * @param \Yamveecee\Config\LoaderInterface $configLoader
     * @return void
     */
    public function addConfigurationLoaderService(\Yamveecee\Config\LoaderInterface $configLoader);

    /**
     * @return \Yamveecee\Config\LoaderInterface
     */
    public function getConfigLoader();

    /**
     * @return \Yamveecee\Request\FactoryInterface
     */
    public function getRequestFactory();
}
