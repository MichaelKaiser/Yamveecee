<?php
namespace Yamveecee\Config\Factory;

use Yamveecee\Config\ConfigInterface;
use Yamveecee\Config\FactoryInterface;

/**
 * Class Std
 * @package Yamveecee\Config\Factory
 */
class Std implements FactoryInterface
{
    /**
     * @param mixed $config
     * @return ConfigInterface
     */
    public function makeInstance($config)
    {
        return new \Yamveecee\Service\Configuration($config);
    }
}
