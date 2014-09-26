<?php
namespace Yamveecee\Service;

use Yamveecee\Config\ConfigInterface;


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
     * @param \Yamveecee\Resources\Finder $finder
     */
    public function setResourceFinder(\Yamveecee\Resources\Finder $finder)
    {
        $this->finder = $finder;
    }

    /**
     * @param $path
     * @return bool
     * @throws ConfigurationException
     * @throws \Yamveecee\Resources\IllegalPathException
     */
    public function addPath($path)
    {
        if (null === $this->finder) {
            throw new \Yamveecee\Service\ConfigurationException('no resource finder set in classfinder service');
        }
        return $this->finder->addPath($path);
    }
}
