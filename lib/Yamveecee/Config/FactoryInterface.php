<?php
namespace Yamveecee\Config;

/**
 * Interface FactoryInterface
 * @package Yamveecee\Config
 */
interface FactoryInterface
{
    /**
     * @param mixed $config
     * @return ConfigInterface
     */
    public function makeInstance($config);
}
