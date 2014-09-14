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
     *
     */
    public function __construct()
    {
        $this->pathes = new \ArrayIterator();
    }

    /**
     * @param string $path
     * @throws \Yamveecee\Resources\IllegalPathException
     */
    public function addPath($path)
    {
        $path = $this->validatePath($path);
        $this->pathes->append($path);
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
                if (file_exists($lookupFileDto->getFullFileName())) {
                    return $lookupFileDto;
                }
            }
        }
        $exp = new \Yamveecee\Resources\NotFoundException('resource ' . $name . ' not found');
        throw $exp;
    }
}
