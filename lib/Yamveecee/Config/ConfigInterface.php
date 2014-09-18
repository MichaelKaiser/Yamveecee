<?php
/**
 * Created by PhpStorm.
 * User: kaiser
 * Date: 18.09.2014
 * Time: 07:37
 */
namespace Yamveecee\Config;


/**
 * Class Configuration
 * @package Yamveecee\Service
 */
interface ConfigInterface
{
    /**
     * @param $name
     * @return null|mixed
     */
    public function getProperty($name);
}