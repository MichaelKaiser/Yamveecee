<?php
namespace Yamveecee\Config\Parser;

/**
 * Class Json
 * @package Yamveecee\Resources\Parser
 */
class Json implements \Yamveecee\Config\ParserInterface
{

    /**
     * @param $fileName
     * @throws \Yamveecee\Resources\EmptyContentException
     * @throws Exception
     * @return \stdClass
     */
    public function parse($fileName)
    {
        $content = $this->getContent($fileName);
        if ($content === null) {
            $exc = new \Yamveecee\Resources\EmptyContentException();
            $exc->setResourceName($fileName);
            throw $exc;
        }
        $object = @json_decode($content);
        if (!is_object($object)) {
            $exc = new \Yamveecee\Config\Parser\Exception('content is no valid json');
            $exc->setResourceName($fileName);
            throw $exc;
        }
        return $object;
    }

    /**
     * @param $fileName
     * @return string
     */
    private function getContent($fileName)
    {
        return file_get_contents($fileName);
    }
}
