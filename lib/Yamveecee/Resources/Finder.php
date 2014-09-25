<?php
namespace Yamveecee\Resources;

/**
 * Class Finder
 * @package Yamveecee\Resources
 */
class Finder
{
    /**
     * @var \ArrayIterator
     */
    protected $pathes = null;

    /**
     * @var \Yamveecee\FileFactory
     */
    protected $fileFactory = null;

    /**
     *
     */
    public function __construct()
    {
        $this->pathes = new \ArrayIterator();
    }

    /**
     * @param string $path
     * @return bool
     * @throws \Yamveecee\Resources\IllegalPathException
     */
    public function addPath($path)
    {
        $path = $this->validatePath($path);
        $this->pathes->append($path);
        return true;
    }

    /**
     * @param $path
     * @return string
     * @throws \Yamveecee\Resources\IllegalPathException
     */
    private function validatePath($path)
    {
        if (!preg_match('#' . DIRECTORY_SEPARATOR . '$#', $path)) {
            $path .= DIRECTORY_SEPARATOR;
        }
        if (!is_dir($path)) {
            $exc = new \Yamveecee\Resources\IllegalPathException('path is not valid or not accessible');
            $exc->setPath($path);
            throw $exc;
        }
        return $path;
    }

    /**
     * @param string $name
     * @param array $extensionList
     * @throws NotFoundException
     * @return \Yamveecee\Resources\Dto
     */
    public function find($name, array $extensionList)
    {
        foreach ($this->pathes as $path) {
            foreach ($extensionList as $extension) {
                $lookupFileDto = new \Yamveecee\Resources\Dto(
                    $path,
                    $name,
                    $extension
                );
                $file = $this->getFileFactory()->makeInstance($lookupFileDto);
                if ($file->exists()) {
                    return $lookupFileDto;
                }
            }
        }
        $exp = new \Yamveecee\Resources\NotFoundException('resource ' . $name . ' not found');
        throw $exp;
    }

    /**
     * @return \Yamveecee\FileFactory
     */
    protected function getFileFactory()
    {
        if ($this->fileFactory === null) {
            $this->fileFactory = new \Yamveecee\FileFactory();
        }
        return $this->fileFactory;
    }

    /**
     * @param \Yamveecee\FileFactory $factory
     */
    public function setFileFactory(\Yamveecee\FileFactory $factory)
    {
        $this->fileFactory = $factory;
    }
}
