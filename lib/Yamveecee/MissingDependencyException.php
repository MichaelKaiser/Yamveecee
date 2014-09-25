<?php
namespace Yamveecee;

/**
 * Class MissingDependencyException
 * @package Yamveecee
 */
class MissingDependencyException extends \Exception
{
    /**
     * @var string
     */
    protected $whoIsMissingName = '';

    /**
     * @var string
     */
    protected $whatIsMissingName = '';

    /**
     * @return string
     */
    public function getWhatIsMissingName()
    {
        return $this->whatIsMissingName;
    }

    /**
     * @param string $whatIsMissingName
     */
    public function setWhatIsMissingName($whatIsMissingName)
    {
        $this->whatIsMissingName = $whatIsMissingName;
    }

    /**
     * @return string
     */
    public function getWhoIsMissingName()
    {
        return $this->whoIsMissingName;
    }

    /**
     * @param string $whoIsMissingName
     */
    public function setWhoIsMissingName($whoIsMissingName)
    {
        $this->whoIsMissingName = $whoIsMissingName;
    }
}
