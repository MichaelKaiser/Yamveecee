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
     * @return mixed|null
     */
    public function getProperty($name)
    {
        return $this->getPropertyInPath($name, $this->config);
    }

    /**
     * @param $name
     * @param \stdClass $subEntity
     * @return null|mixed
     */
    protected function getPropertyInPath($name, \stdClass $subEntity)
    {
        $return = null;
        if (strpos($name, '\\') !== false) {
            list($currentPropertyName, $remainingPath) = explode('\\', $name, 2);
            if (property_exists($subEntity, $currentPropertyName)) {
                $property = $subEntity->$currentPropertyName;
                if ($property instanceof \stdClass) {
                    $return = $this->getPropertyInPath($remainingPath, $property);
                }
            }
        } elseif (property_exists($subEntity, $name)) {
            $return = $subEntity->$name;
        }
        return $return;
    }
}
