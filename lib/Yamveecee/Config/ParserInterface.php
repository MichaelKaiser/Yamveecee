<?php
namespace Yamveecee\Config;

/**
 * Interface ParserInterface
 * @package Yamveecee\Config
 */
interface ParserInterface
{
    /**
     * @param \Yamveecee\File $file
     * @return \stdClass
     */
    public function parse(\Yamveecee\File $file);
}
