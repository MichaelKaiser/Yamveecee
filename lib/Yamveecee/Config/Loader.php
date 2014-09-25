<?php
namespace Yamveecee\Config;

use Yamveecee\Service\Enum;

/**
 * Class Loader
 * @package Yamveecee\Config
 */
class Loader implements \Yamveecee\ServiceInterface, LoaderInterface
{
    /**
     * @var \Yamveecee\Resources\Finder
     */
    protected $configFinder = null;

    /**
     * @var ConfigInterface
     */
    protected $serviceConfig = null;

    /**
     * @var \Yamveecee\Config\ParserInterface[]
     */
    protected $extensionParserMap = array();

    /**
     * @var array
     */
    protected $cache = array();

    /**
     * @var \Yamveecee\Config\FactoryInterface
     */
    protected $configFactory = null;

    /**
     * @param \Yamveecee\Resources\Finder $configFinder
     */
    public function setResourcesFinder(\Yamveecee\Resources\Finder $configFinder)
    {
        $this->configFinder = $configFinder;
    }

    /**
     * @param $name
     * @return ConfigInterface
     */
    public function getConfig($name)
    {
        $config = null;
        if (array_key_exists($name, $this->cache)) {
            $config = $this->cache[$name];
        } else {
            $fileToLoadDto = $this->configFinder->find($name, $this->getSupportedExtensions());
            $config = $this->createConfigInstance($fileToLoadDto);
        }
        return $config;
    }

    /**
     * @param ConfigInterface $config
     * @return void
     */
    public function setServiceConfig(\Yamveecee\Config\ConfigInterface $config)
    {
        $this->serviceConfig = $config;
    }

    /**
     * self injecting Service for anything has to be the hen or egg
     * @return void
     */
    public function init()
    {
        $config = $this->getConfig(Enum::CONFIGLOADER);
        if (null !== $config) {
            $this->setServiceConfig($config);
        }
    }

    /**
     * @param $extension
     * @param ParserInterface $parser
     */
    public function addParser($extension, \Yamveecee\Config\ParserInterface $parser)
    {
        $this->extensionParserMap[$extension] = $parser;
    }

    /**
     * @return array
     */
    private function getSupportedExtensions()
    {
        return array_keys($this->extensionParserMap);
    }

    /**
     * @param \Yamveecee\Resources\Dto $fileToLoadDto
     * @return ConfigInterface
     */
    private function createConfigInstance(\Yamveecee\Resources\Dto $fileToLoadDto)
    {
        $configFactory = $this->getConfigFactory();
        $config = $configFactory->makeInstance(
            $this->extensionParserMap[$fileToLoadDto->getExtension()]->parse(
                new \Yamveecee\File($fileToLoadDto)
            )
        );
        return $config;
    }

    /**
     * @return FactoryInterface
     */
    private function getConfigFactory()
    {
        if (null === $this->configFactory) {
            $factoryClassName = $this->getConfigFactoryClassName();
            $this->configFactory = new $factoryClassName();
        }
        return $this->configFactory;
    }

    /**
     * @return string
     */
    private function getConfigFactoryClassName()
    {
        $className = '\Yamveecee\Config\Factory\Std';
        $configClassName = $this->serviceConfig->getProperty('configFactory\className');
        if (null !== $configClassName) {
            $className = $configClassName;
        }
        return $className;
    }
}
