<?php

use CiscoDelgado\Types\ValueObject\BooleanValueObject;

class BooleanValueObjectTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_should_create_a_negate_boolean_object()
    {
        $booleanValue = BooleanValueObject::negate(new BooleanValueObject(true));

        $this->assertFalse($booleanValue->value());
    }

    /** @test */
    public function it_should_return_the_opposite_value()
    {
        $trueValue = new BooleanValueObject(true);

        $this->assertFalse($trueValue->opposite()->value());
    }
}
