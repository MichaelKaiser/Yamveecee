<?php
namespace Yamveecee\Resources;

/**
 * Class EmptyContentException
 * @package Yamveecee\Resources
 */
class EmptyContentException extends \Exception
{
    /**
     * @var string
     */
    protected $resourceName = '';

    /**
     *
     */
    public function __construct()
    {
        parent::__construct('Empty Content');
    }

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
