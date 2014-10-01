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
     * @var \Yamveecee\Route\RouteInterface[]
     */
    protected $routes = null;

    /**
     * @var \Yamveecee\Controller\FactoryInterface
     */
    protected $controllerFactory = null;

    /**
     * @var \Yamveecee\Route\FactoryInterface
     */
    protected $routesFactory = null;

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
     * @param \Yamveecee\ResponseInterface|null $response
     * @throws \Yamveecee\Controller\NoControllerException
     * @return \Yamveecee\ResponseInterface
     */
    public function route(\Yamveecee\RequestInterface $request, \Yamveecee\ResponseInterface $response = null)
    {
        $controller = $this->getController($request);
        if (null === $controller) {
            $exc = new \Yamveecee\Controller\NoControllerException('No controller found');
            $exc->setUri($request->getUri());
            throw $exc;
        }
        return $controller->execute($request, $response);
    }

    /**
     * @param \Yamveecee\RequestInterface $request
     * @return \Yamveecee\Controller\ControllerInterface
     */
    private function getController(\Yamveecee\RequestInterface $request)
    {
        foreach ($this->getRouteInstances() as $route) {
            if ($route->isMatching($request)) {
                $request->setRoute($route);
                return $this->createControllerInstance($request);
            }
        }
        return null;
    }

    /**
     * @return \Yamveecee\Route\RouteInterface[]
     */
    private function getRouteInstances()
    {
        if (null === $this->routes) {
            $this->routes = array();
            foreach ($this->getRoutesConfig() as $routeName => $config) {
                $this->getRoutesFactory()->makeInstance($routeName, $config);
            }
        }
        return $this->routes;
    }

    /**
     * @param \Yamveecee\RequestInterface $request
     * @return \Yamveecee\Controller\ControllerInterface
     */
    private function createControllerInstance(\Yamveecee\RequestInterface $request)
    {
        return $this->getControllerFactory()->makeInstance($request->getRoute());
    }

    /**
     * @return \Yamveecee\Controller\FactoryInterface
     */
    private function getControllerFactory()
    {
        if (null === $this->controllerFactory) {
            $factoryClassName = $this->getConfiguredFactoryName(
                'controllerFactoryClassName',
                '\Yamveecee\Controller\Factory'
            );
            $this->controllerFactory = new $factoryClassName();
            $this->controllerFactory->setControllerNamespace($this->serviceConfig->getProperty('controllerNamespace'));
        }
        return $this->controllerFactory;
    }

    /**
     * @param \Yamveecee\Controller\FactoryInterface $factory
     */
    public function setControllerFactory(\Yamveecee\Controller\FactoryInterface $factory)
    {
        $this->controllerFactory = $factory;
    }

    /**
     * @return array
     */
    private function getRoutesConfig()
    {
        $routesConfig = $this->serviceConfig->getProperty('routes');
        return is_array($routesConfig) ? $routesConfig : array();
    }

    /**
     * @return string
     */
    private function getConfiguredFactoryName($propertyName, $defaultClassName)
    {
        $className = $defaultClassName;
        $configuredClassName = $this->serviceConfig->getProperty($propertyName);
        if (null !== $configuredClassName) {
            $className = $configuredClassName;
        }
        return $className;
    }

    /**
     * @return \Yamveecee\Route\FactoryInterface
     */
    private function getRoutesFactory()
    {
        if (null == $this->routesFactory) {
            $factoryClassName = $this->getConfiguredFactoryName(
                'routesFactoryClassName',
                '\Yamveecee\Route\Factory'
            );
            $this->routesFactory = new $factoryClassName;
        }
        return $this->routesFactory;
    }

    /**
     * @param \Yamveecee\Route\FactoryInterface $factory
     */
    public function setRoutesFactory(\Yamveecee\Route\FactoryInterface $factory)
    {
        $this->routesFactory = $factory;
    }
}
