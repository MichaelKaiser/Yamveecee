<?php

namespace Yamveecee\Service;

use Yamveecee\Config\ConfigInterface;

/**
 * Class Configuration
 * @package Yamveecee\Service
 */
class Configuration implements ConfigInterface
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
     * @param \stdClass|null $subEntity
     * @return null|mixed
     */
    public function getProperty($name, \stdClass $subEntity = null)
    {
        $return = null;
        if (null === $subEntity) {
            $subEntity = $this->config;
        }
        if (strpos($name, '\\') !== false) {
            list($currentPropertyName, $remainingPath) = explode('\\', $name, 2);
            if (property_exists($subEntity, $currentPropertyName)) {
                $property = $subEntity->$currentPropertyName;
                if ($property instanceof \stdClass) {
                    $return = $this->getProperty($remainingPath, $property);
                }
            }
        } elseif (property_exists($name, $subEntity)) {
            $return = $subEntity->$name;
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
