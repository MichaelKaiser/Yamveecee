<?php
namespace Yamveecee;

/**
 * Class FileFactory
 * @package Yamveecee
 */
class FileFactory
{
    /**
     * @param Resources\Dto $dto
     * @return File
     */
    public function makeInstance(\Yamveecee\Resources\Dto $dto)
    {
        return new \Yamveecee\File($dto);
    }
}
