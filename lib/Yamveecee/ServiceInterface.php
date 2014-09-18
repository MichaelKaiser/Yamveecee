<?php
namespace Yamveecee;

/**
 * Interface ServiceInterface
 * @package Yamveecee
 */
interface ServiceInterface
{
    /**
     * @param Config\ConfigInterface $config
     * @return void
     */
    public function setServiceConfig(\Yamveecee\Config\ConfigInterface $config);
}
