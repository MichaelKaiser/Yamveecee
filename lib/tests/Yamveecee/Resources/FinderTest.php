<?php
namespace YamveeceeTest\Resources;

/**
 * Class FinderTest
 * @package YamveeceeTest\Resources
 */
class FinderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException \Yamveecee\Resources\IllegalPathException
     */
    public function addPath_pathDoesNotExists()
    {
        // prepare
        $classUnderTest = new \Yamveecee\Resources\Finder();

        // test
        $classUnderTest->addPath('invalidPath');

        // verified by annotation
    }

    /**
     * @test
     */
    public function addPath_pathExists()
    {
        // prepare
        $classUnderTest = new \Yamveecee\Resources\Finder();

        // test
        $result = $classUnderTest->addPath('.');

        // verify
        $this->assertTrue($result);
    }

    /**
     * @test
     * @expectedException \Yamveecee\Resources\NotFoundException
     */
    public function find_notExisting()
    {
        // prepare
        $classUnderTest = new \Yamveecee\Resources\Finder();
        $classUnderTest->addPath('.');

        // test
        $classUnderTest->find('someName', array('anExtension'));
    }

    /**
     * @test
     */
    public function find_existingResource()
    {
        // prepare
        $classUnderTest = new \Yamveecee\Resources\Finder();
        $classUnderTest->addPath('.');

        $expectedResult = new \Yamveecee\Resources\Dto(
            '.' . DIRECTORY_SEPARATOR,
            'someName',
            'anExtension'
        );

        $fileMock = $this->getMockBuilder('\Yamveecee\File')
            ->disableOriginalConstructor()
            ->getMock();
        $fileMock->expects($this->once())
            ->method('exists')
            ->will($this->returnValue(true));
        $fileFactoryMock = $this->getMock('\Yamveecee\FileFactory');
        $fileFactoryMock->expects($this->once())
            ->method('makeInstance')
            ->will($this->returnValue($fileMock));
        $classUnderTest->setFileFactory($fileFactoryMock);

        // test
        $result = $classUnderTest->find(
            $expectedResult->getName(),
            array($expectedResult->getExtension())
        );

        $this->assertEquals($expectedResult, $result);
    }
}
