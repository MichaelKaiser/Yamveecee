<?php
namespace Yamveecee\Config;

/**
 * Class Loader
 * @package Yamveecee\Config
 */
interface LoaderInterface
{
    /**
     * @param $name
     * @return ConfigInterface
     */
    public function getConfig($name);
}
