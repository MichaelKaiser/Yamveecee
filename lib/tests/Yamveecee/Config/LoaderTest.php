<?php
namespace YamveeceeTest\Config;

/**
 * Class LoaderTest
 * @package YamveeceeTest\Config
 */
class LoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException \Yamveecee\MissingDependencyException
     */
    public function getConfig_configFinderNotSetConfigNotCached()
    {
        // prepare
        $classUnderTest = new \Yamveecee\Config\Loader();

        // test
        $classUnderTest->getConfig('dummy');

        // verified by annotation

    }

    /**
     * @test
     * @expectedException \Yamveecee\Resources\NotFoundException
     */
    public function getConfig_configFileNotFound()
    {
        // prepare
        $classUnderTest = new \Yamveecee\Config\Loader();

        $finderMock = $this->getMock('\Yamveecee\Resources\Finder');
        $finderMock->expects($this->once())
            ->method('find')
            ->will($this->throwException(new \Yamveecee\Resources\NotFoundException()));
        $classUnderTest->setResourcesFinder($finderMock);

        // test
        $classUnderTest->getConfig('dummy');

        // verified by annotation
    }

    /**
     * @test
     * @expectedException \Yamveecee\Config\Parser\Exception
     */
    public function getConfig_noParserForConfigExtension()
    {
        // prepare
        $classUnderTest = new \Yamveecee\Config\Loader();

        $fileDto = new \Yamveecee\Resources\Dto('nowhere', 'nofile', 'invalidExtension');

        $finderMock = $this->getMock('\Yamveecee\Resources\Finder');
        $finderMock->expects($this->once())
            ->method('find')
            ->will($this->returnValue($fileDto));
        $classUnderTest->setResourcesFinder($finderMock);

        $configFactoryMock = $this->getMock('\Yamveecee\Config\FactoryInterface');
        $classUnderTest->setConfigFactory($configFactoryMock);

        // test
        $classUnderTest->getConfig('dummy');

        // verified by annotation
    }

    /**
     * @test
     */
    public function getConfig_valid()
    {
        // prepare
        $classUnderTest = new \Yamveecee\Config\Loader();

        $expectedResult = $this->getMock('\Yamveecee\Config\ConfigInterface');

        $parserMock = $this->getMock('\Yamveecee\Config\ParserInterface');
        $parserMock->expects($this->once())
            ->method('parse')
            ->will($this->returnValue(new \stdClass()));
        $classUnderTest->addParser('validExtension', $parserMock);

        $fileDto = new \Yamveecee\Resources\Dto('nowhere', 'nofile', 'validExtension');

        $finderMock = $this->getMock('\Yamveecee\Resources\Finder');
        $finderMock->expects($this->once())
            ->method('find')
            ->will($this->returnValue($fileDto));
        $classUnderTest->setResourcesFinder($finderMock);

        $configFactoryMock = $this->getMock('\Yamveecee\Config\FactoryInterface');
        $configFactoryMock->expects($this->once())
            ->method('makeInstance')
            ->will($this->returnValue($expectedResult));
        $classUnderTest->setConfigFactory($configFactoryMock);

        // test
        $result = $classUnderTest->getConfig('dummy');

        // verify
        $this->assertEquals($expectedResult, $result);
    }
}
