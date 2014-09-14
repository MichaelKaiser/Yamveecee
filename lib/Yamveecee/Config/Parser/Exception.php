<?php
namespace Yamveecee\Config\Parser;

/**
 * Class Exception
 * @package Yamveecee\Resources\Parser
 */
class Exception extends \Exception
{
    /**
     * @var string
     */
    protected $resourceName = '';

    /**
     * @param string $resourceName
     */
    public function setResourceName($resourceName)
    {
        $this->resourceName = $resourceName;
    }

    /**
     * @return string
     */
    public function getResourceName()
    {
        return $this->resourceName;
    }
}
