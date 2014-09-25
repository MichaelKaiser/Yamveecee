<?php
namespace YamveeceeTest\Config\Parser;

/**
 * Class JsonTest
 * @package YamveeceeTest\Config\Parser
 */
class JsonTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException \Yamveecee\Resources\EmptyContentException
     */
    public function parse_emptyContent()
    {
        // prepare
        $classUnderTest = new \Yamveecee\Config\Parser\Json();

        $fileMock = $this->getMockBuilder('\Yamveecee\File')
            ->disableOriginalConstructor()
            ->getMock();

        // test
        $classUnderTest->parse($fileMock);

        // verified by annotation
    }

    /**
     * @test
     * @expectedException \Yamveecee\Config\Parser\Exception
     */
    public function parse_NonJsonContent()
    {
        // prepare
        $classUnderTest = new \Yamveecee\Config\Parser\Json();

        $fileMock = $this->getMockBuilder('\Yamveecee\File')
            ->disableOriginalConstructor()
            ->getMock();
        $fileMock->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue('This is not an object'));

        // test
        $classUnderTest->parse($fileMock);

        // verified by annotation
    }

    /**
     * @test
     */
    public function parse_validJsonContent()
    {
        // prepare
        $classUnderTest = new \Yamveecee\Config\Parser\Json();

        $expectedResult = new \stdClass();

        $fileMock = $this->getMockBuilder('\Yamveecee\File')
            ->disableOriginalConstructor()
            ->getMock();
        $fileMock->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue(json_encode($expectedResult)));

        // test
        $result = $classUnderTest->parse($fileMock);

        // verify
        $this->assertEquals($expectedResult, $result);
    }
}
