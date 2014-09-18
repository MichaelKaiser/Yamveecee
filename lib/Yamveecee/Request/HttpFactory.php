<?php
namespace Yamveecee\Request;

/**
 * Class HttpFactory
 * @package Yamveecee\Request
 */
class HttpFactory implements \Yamveecee\Request\FactoryInterface
{
    /**
     * @return \Yamveecee\RequestInterface
     */
    public function getRequest()
    {
        $request = new \Yamveecee\Request\Http();
        // TODO: Implement getRequest() method.
        return $request;
    }
}
