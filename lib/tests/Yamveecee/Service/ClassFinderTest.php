<?php
namespace YamveeceeTest\Service;

/**
 * Class ClassFinderTest
 * @package YamveeceeTest\Service
 */
class ClassFinderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException \Yamveecee\Service\ConfigurationException
     */
    public function addPath_finderNotSet()
    {
        // prepare
        $classUnderTest = new \Yamveecee\Service\ClassFinder();

        // test
        $classUnderTest->addPath('somepath');

        // verified by annotation
    }

    /**
     * @test
     * @expectedException \Yamveecee\Resources\IllegalPathException
     */
    public function addPath_invalidPath()
    {
        // prepare
        $classUnderTest = new \Yamveecee\Service\ClassFinder();
        $classUnderTest->setResourceFinder(
            new \Yamveecee\Resources\Finder()
        );

        // test
        $classUnderTest->addPath('somepath');

        // verified by annotation
    }

    /**
     * @test
     */
    public function addPath_validPath()
    {
        // prepare
        $classUnderTest = new \Yamveecee\Service\ClassFinder();
        $classUnderTest->setResourceFinder(
            new \Yamveecee\Resources\Finder()
        );

        // test
        $result = $classUnderTest->addPath('.');

        // verify
        $this->assertTrue($result);
    }
}
