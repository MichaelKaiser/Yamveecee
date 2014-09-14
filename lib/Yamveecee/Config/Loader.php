<?php
namespace Yamveecee\Config;

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
     * @var \Yamveecee\Service\Configuration
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
     * @param \Yamveecee\Resources\Finder $configFinder
     */
    public function setResourcesFinder(\Yamveecee\Resources\Finder $configFinder)
    {
        $this->configFinder = $configFinder;
    }

    /**
     * @param $name
     * @return \Yamveecee\Service\Configuration
     */
    public function getConfig($name)
    {
        $config = null;
        if (array_key_exists($name, $this->cache)) {
            $config = $this->cache[$name];
        } else {
            $fileToLoadDto = $this->configFinder->find($name, $this->getSupportedExtensions());
            $config = new \Yamveecee\Service\Configuration(
                $this->extensionParserMap[$fileToLoadDto->getExtension()]->parse($fileToLoadDto->getFullFileName())
            );
        }
        return $config;
    }

    /**
     * @param \Yamveecee\Service\Configuration $config
     * @return void
     */
    public function setServiceConfig(\Yamveecee\Service\Configuration $config)
    {
        $this->serviceConfig = $config;
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
}
