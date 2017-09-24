<?php

use CiscoDelgado\Types\ValueObject\Enum;

class EnumTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException CiscoDelgado\Types\ValueObject\Exception\InvalidEnumValueException
     */
    public function it_should_complaint_with_not_allowed_values()
    {
        new DummyEnum('third');
    }
}

class DummyEnum extends Enum
{
    const FIRST_VALUE = 'first';
    const SECOND_VALUE = 'second';
}
