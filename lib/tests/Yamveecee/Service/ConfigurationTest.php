<?php
namespace YamveeceeTest\Service;

/**
 * Class ConfigurationTest
 * @package YamveeceeTest\Service
 */
class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function getProperty_nonExistingPropertyWithoutPathing()
    {
        // prepare
        $config = new \stdClass();
        $classUnderTest = new \Yamveecee\Service\Configuration($config);

        // test
        $result = $classUnderTest->getProperty('nonExisting');

        // verify
        $this->assertNull($result);
    }

    /**
     * @test
     */
    public function getProperty_existingPropertyWithoutPathing()
    {
        // prepare
        $expectedResult = 'someValue';
        $config = new \stdClass();
        $config->Existing = $expectedResult;
        $classUnderTest = new \Yamveecee\Service\Configuration($config);

        // test
        $result = $classUnderTest->getProperty('Existing');

        // verify
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function getProperty_existingPropertyWithPathingSubEntityIsScalar()
    {
        $expectedResult = 'someValue';
        $config = new \stdClass();
        $config->Existing = new \stdClass();
        $config->Existing->SubEntity = $expectedResult;
        $classUnderTest = new \Yamveecee\Service\Configuration($config);

        // test
        $result = $classUnderTest->getProperty('Existing\SubEntity');

        // verify
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function getProperty_existingPropertyWithPathingSubEntityIsNotAnObjectAsExpected()
    {
        $config = new \stdClass();
        $config->Existing = new \stdClass();
        $config->Existing->SubEntity = 'scalarValue';
        $classUnderTest = new \Yamveecee\Service\Configuration($config);

        // test
        $result = $classUnderTest->getProperty('Existing\SubEntity\AnyKey');

        // verify
        $this->assertNull($result);
    }
}
