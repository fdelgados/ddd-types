<?php

use CiscoDelgado\Types\ValueObject\StringValueObject;

class StringValueObjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException CiscoDelgado\Types\ValueObject\Exception\EmptyValueException
     */
    public function it_should_not_allow_empty_strings()
    {
        $stringValueObject = new StringDummy('');
    }
}

class StringDummy extends StringValueObject
{
}
