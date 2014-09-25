<?php
namespace Yamveecee;

/**
 * Class File
 * @package Yamveecee
 */
class File
{
    /**
     * @var \Yamveecee\Resources\Dto
     */
    protected $dto;

    /**
     * @param Resources\Dto $dto
     */
    public function __construct(\Yamveecee\Resources\Dto $dto)
    {
        $this->dto = $dto;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return file_get_contents($this->dto->getFullFileName());
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->dto->getFullFileName();
    }
}
