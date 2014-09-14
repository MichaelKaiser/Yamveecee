<?php

namespace Yamveecee\Service;

/**
 * Class ServiceLocator
 * @package Yamveecee\Service
 */
class Locator implements \Yamveecee\Service\LocatorInterface
{
    /**
     * @var Configuration
     */
    protected $config = null;
    /**
     * @var \Yamveecee\Service\LocatorInterface
     */
    protected static $instance = null;

    /**
     * @var \Yamveecee\ServiceInterface[]
     */
    protected $services = array();

    /**
     * @param Configuration|null $config
     * @throws ConfigurationException
     * @return \Yamveecee\Service\LocatorInterface
     */
    public static function getInstance(Configuration $config = null)
    {
        if (self::$instance === null) {
            if ($config === null) {
                $className = '\Yamveecee\Service\Locator';
            } else {
                $className = $config->getProperty('className');
            }

            if (!class_exists($className)) {
                $exc = new \Yamveecee\Service\ConfigurationException(
                    'serviceLocator class ' . $className . ' does not exists'
                );
                throw $exc;
            }

            self::$instance = new $className();
            self::$instance->setServiceConfig($config);
        }
        return self::$instance;
    }

    /**
     * @param Configuration $config
     * @return void
     */
    public function setServiceConfig(\Yamveecee\Service\Configuration $config)
    {
        $this->config = $config;
    }

    /**
     * @param string $serviceName
     * @param \Yamveecee\ServiceInterface $service
     * @return void
     */
    public function addService($serviceName, \Yamveecee\ServiceInterface $service)
    {
        $this->services[$serviceName] = $service;
    }

    /**
     * @return \Yamveecee\DispatcherInterface
     */
    public function getDispatcher()
    {
        return $this->getService(Enum::DISPATCHER);
    }

    /**
     * @param string $serviceName
     * @return \Yamveecee\ServiceInterface
     */
    public function getService($serviceName)
    {
        if (!array_key_exists($serviceName, $this->services)) {
            $service = $this->getServiceInstance($serviceName);
            $this->services[$serviceName] = $service;
        } else {
            $service = $this->services[$serviceName];
        }
        return $service;
    }

    /**
     * @param \Yamveecee\Config\LoaderInterface $configLoader
     * @return void
     */
    public function addConfigurationLoaderService(\Yamveecee\Config\LoaderInterface $configLoader)
    {
        $this->addService(Enum::CONFIGLOADER, $configLoader);
    }

    /**
     * @return \Yamveecee\Config\LoaderInterface
     */
    public function getConfigLoader()
    {
        return $this->getService(Enum::CONFIGLOADER);
    }

    /**
     * @return \Yamveecee\Request\FactoryInterface
     */
    public function getRequestFactory()
    {
        return $this->getService(Enum::REQUESTFACTORY);
    }

    /**
     * @param string $serviceName
     * @throws ConfigurationException
     * @return \Yamveecee\ServiceInterface
     */
    private function getServiceInstance($serviceName)
    {
        $service = null;
        $config = $this->getConfigLoader()->getConfig($serviceName);
        $className = $config->getClassName();
        if (class_exists($className)) {
            $service = new $className();
            if ($service instanceof \Yamveecee\ServiceInterface) {
                $service->setServiceConfig($config);
            } else {
                $exp = new \Yamveecee\Service\ConfigurationException(
                    'class ' . $className . ' does not implement ServiceInterface'
                );
                throw $exp;
            }
        } else {
            $exp = new \Yamveecee\Service\ConfigurationException(
                'class ' . $className . ' does not exists for service ' . $serviceName
            );
            throw $exp;
        }
        return $service;
    }
}
