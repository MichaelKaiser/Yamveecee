<?php
namespace Yamveecee;

/**
 * Class Classloader
 * @package Yamveecee\Core
 */
class Classloader
{
    /**
     * @var \Yamveecee\Resources\Finder
     */
    protected $finder = null;

    /**
     * @var array
     */
    protected $classFileExtensions = array('.php');

    /**
     *
     */
    public function register()
    {
        spl_autoload_register(array($this, 'loadClass'));
    }

    /**
     *
     */
    public function unregister()
    {
        spl_autoload_unregister(array($this, 'loadClass'));
    }

    /**
     * @param $className
     */
    public function loadClass($className)
    {
        $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        if (null !== $this->finder) {
            $fileToIncludeDto = $this->finder->find($fileName, $this->classFileExtensions);
            require $fileToIncludeDto->getFullFileName();
        } else {
            require $fileName;
        }
    }

    /**
     * @param Resources\Finder $classFinder
     */
    public function setResourceFinder(\Yamveecee\Resources\Finder $classFinder)
    {
        $this->finder = $classFinder;
    }
}
