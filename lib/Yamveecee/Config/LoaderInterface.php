<?php
namespace Yamveecee\Config;

/**
 * Class Loader
 * @package Yamveecee\Config
 */
interface LoaderInterface extends \Yamveecee\ServiceInterface
{
    /**
     * @param $name
     * @return ConfigInterface
     */
    public function getConfig($name);
}
