<?php
namespace Yamveecee\Service;

/**
 * Class ClassFinder
 * @package Yamveecee\Service
 */
class ClassFinder implements \Yamveecee\ServiceInterface
{
    /**
     * @var \Yamveecee\Resources\Finder
     */
    protected $finder = null;

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
     * @param \Yamveecee\Resources\Finder $finder
     */
    public function setResourceFinder(\Yamveecee\Resources\Finder $finder)
    {
        $this->finder = $finder;
    }

    /**
     * @param $path
     * @throws ConfigurationException
     */
    public function addPath($path)
    {
        if (null === $this->finder) {
            throw new \Yamveecee\Service\ConfigurationException('no resource finder set in classfinder service');
        }
        $this->finder->addPath($path);
    }
}
