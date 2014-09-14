<?php
namespace Yamveecee\Config;

/**
 * Interface ParserInterface
 * @package Yamveecee\Config
 */
interface ParserInterface
{
    /**
     * @param $fileName
     * @return \stdClass
     */
    public function parse($fileName);
}
