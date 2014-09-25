<?php
namespace Yamveecee\Config\Parser;

/**
 * Class Json
 * @package Yamveecee\Resources\Parser
 */
class Json implements \Yamveecee\Config\ParserInterface
{

    /**
     * @param \Yamveecee\File $file
     * @return \stdClass
     * @throws Exception
     * @throws \Yamveecee\Resources\EmptyContentException
     */
    public function parse(\Yamveecee\File $file)
    {
        $content = $file->getContent();
        if ($content === null) {
            $exc = new \Yamveecee\Resources\EmptyContentException();
            $exc->setResourceName($file->getFilename());
            throw $exc;
        }
        $object = @json_decode($content);
        if (!is_object($object)) {
            $exc = new \Yamveecee\Config\Parser\Exception('content is no valid json');
            $exc->setResourceName($file->getFilename());
            throw $exc;
        }
        return $object;
    }
}
