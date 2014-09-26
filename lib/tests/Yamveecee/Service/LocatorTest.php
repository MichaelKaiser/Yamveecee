<?php
namespace YamveeceeTest\Service;

use Yamveecee\Config;

/**
 * Class ServiceFake
 * @package YamveeceeTest\Service
 */
class ServiceFake implements \Yamveecee\ServiceInterface
{
    /**
     * @param Config\ConfigInterface $config
     * @return void
     */
    public function setServiceConfig(\Yamveecee\Config\ConfigInterface $config)
    {
    }
}

/**
 * Class LocatorTest
 * @package YamveeceeTest\Service
 */
class LocatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException \Yamveecee\Service\ConfigurationException
     */
    public function getConfigLoader_noConfigLoaderSet()
    {
        // prepare
        $classUnderTest = new \Yamveecee\Service\Locator();

        // test
        $classUnderTest->getConfigLoader();

        // verified by annotation
    }

    /**
     * @test
     */
    public function getService_serviceNotInitedYet()
    {
        // prepare
        $classUnderTest = new \Yamveecee\Service\Locator();

        $expectedClass = '\YamveeceeTest\Service\ServiceFake';
        $serviceName = 'notInitedService';

        $configMock = $this->getMock('\Yamveecee\Config\ConfigInterface');
        $configMock->expects($this->once())
            ->method('getProperty')
            ->with('className')
            ->will($this->returnValue($expectedClass));

        $configLoaderMock = $this->getMock('\Yamveecee\Config\LoaderInterface');
        $configLoaderMock->expects($this->any())
            ->method('getConfig')
            ->will($this->returnValue($configMock));
        $classUnderTest->addConfigurationLoaderService($configLoaderMock);

        // test
        $result = $classUnderTest->getService($serviceName);

        // verify
        $this->assertInstanceOf($expectedClass, $result);
    }

    /**
     * @test
     */
    public function getService_serviceAlreadyInited()
    {
        // prepare
        $classUnderTest = new \Yamveecee\Service\Locator();

        $expectedClass = '\YamveeceeTest\Service\ServiceFake';
        $serviceName = 'initedService';

        $configLoaderMock = $this->getMock('\Yamveecee\Config\LoaderInterface');
        $configLoaderMock->expects($this->never())
            ->method('getConfig');
        $classUnderTest->addConfigurationLoaderService($configLoaderMock);

        $classUnderTest->addService($serviceName, new ServiceFake());

        // test
        $result = $classUnderTest->getService($serviceName);

        // verify
        $this->assertInstanceOf($expectedClass, $result);

    }

    /**
     * @test
     * @expectedException \Yamveecee\Resources\NotFoundException
     */
    public function getService_unknownService()
    {
        // prepare
        $classUnderTest = new \Yamveecee\Service\Locator();

        $serviceName = 'notInitedService';

        $configLoaderMock = $this->getMock('\Yamveecee\Config\LoaderInterface');
        $configLoaderMock->expects($this->once())
            ->method('getConfig')
            ->will($this->throwException(new \Yamveecee\Resources\NotFoundException()));
        $classUnderTest->addConfigurationLoaderService($configLoaderMock);

        // test
        $classUnderTest->getService($serviceName);
    }

    /**
     * @test
     * @expectedException \Yamveecee\Service\ConfigurationException
     */
    public function getService_configuredClassDoesNotImplementServiceInterface()
    {
        // prepare
        $classUnderTest = new \Yamveecee\Service\Locator();

        $serviceName = 'notInitedService';

        $configMock = $this->getMock('\Yamveecee\Config\ConfigInterface');
        $configMock->expects($this->once())
            ->method('getProperty')
            ->with('className')
            ->will($this->returnValue('\stdClass'));

        $configLoaderMock = $this->getMock('\Yamveecee\Config\LoaderInterface');
        $configLoaderMock->expects($this->any())
            ->method('getConfig')
            ->will($this->returnValue($configMock));
        $classUnderTest->addConfigurationLoaderService($configLoaderMock);

        // test
        $classUnderTest->getService($serviceName);

        // verified by annotation
    }

    /**
     * @test
     * @expectedException \Yamveecee\Service\ConfigurationException
     */
    public function getService_configuredClassIsUnknown()
    {
        // prepare
        $classUnderTest = new \Yamveecee\Service\Locator();

        $serviceName = 'notInitedService';

        $configMock = $this->getMock('\Yamveecee\Config\ConfigInterface');
        $configMock->expects($this->once())
            ->method('getProperty')
            ->with('className')
            ->will($this->returnValue('anUnknownClass'));

        $configLoaderMock = $this->getMock('\Yamveecee\Config\LoaderInterface');
        $configLoaderMock->expects($this->any())
            ->method('getConfig')
            ->will($this->returnValue($configMock));
        $classUnderTest->addConfigurationLoaderService($configLoaderMock);

        // test
        $classUnderTest->getService($serviceName);

        // verified by annotation
    }
}
