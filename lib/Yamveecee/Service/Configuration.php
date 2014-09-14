<?php

namespace Yamveecee\Service;

/**
 * Class Configuration
 * @package Yamveecee\Service
 */
class Configuration
{
    /**
     * @var \stdClass
     */
    protected $config = null;

    /**
     * @param \stdClass $config
     */
    public function __construct(\stdClass $config)
    {
        $this->config = $config;
    }

    /**
     * @param $name
     * @return null|mixed
     */
    public function getProperty($name)
    {
        $return = null;
        if (property_exists($name, $this->config)) {
            $return = $this->config->$name;
        }
        return $return;
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        return $this->getProperty('className');
    }
}
