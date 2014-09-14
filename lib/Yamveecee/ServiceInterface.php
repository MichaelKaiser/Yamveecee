<?php
namespace Yamveecee;

/**
 * Interface ServiceInterface
 * @package Yamveecee
 */
interface ServiceInterface
{
    /**
     * @param \Yamveecee\Service\Configuration $config
     * @return void
     */
    public function setServiceConfig(\Yamveecee\Service\Configuration $config);
}
