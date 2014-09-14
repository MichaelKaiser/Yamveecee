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
     * @return \Yamveecee\Service\Configuration
     */
    public function getConfig($name);
}
