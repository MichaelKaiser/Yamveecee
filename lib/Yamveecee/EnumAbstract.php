<?php
namespace Yamveecee;

/**
 * Class EnumAbstract
 * @package Yamveecee
 */
class EnumAbstract
{
    /**
     * @param $value
     *
     * @return string
     */
    public static function getConstantNameForValue($value)
    {
        $constantMapping = array_flip(static::getDefinedConstants());
        if (array_key_exists($value, $constantMapping)) {
            return $constantMapping[$value];
        }
        return "constant for value " . $value . " is not defined";
    }

    /**
     * @return array
     */
    private static function getDefinedConstants()
    {
        $reflectionClass = new \ReflectionClass(get_called_class());
        return $reflectionClass->getConstants();
    }
}
