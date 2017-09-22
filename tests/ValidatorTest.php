<?php

namespace CiscoDelgado\Types\Tests;

use CiscoDelgado\Types\Validator;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_should_validate_integers()
    {
        $type = Validator::INTEGER_TYPE;

        $this->assertTrue(Validator::isValid(0, $type));
        $this->assertTrue(Validator::isValid(1, $type));
        $this->assertTrue(Validator::isValid(55868868857577, $type));

        $this->assertFalse(Validator::isValid('0', $type));
        $this->assertFalse(Validator::isValid('1000', $type));
        $this->assertFalse(Validator::isValid('string', $type));
        $this->assertFalse(Validator::isValid(0.1, $type));
        $this->assertFalse(Validator::isValid(false, $type));
        $this->assertFalse(Validator::isValid(true, $type));
    }

    /** @test */
    public function it_should_validate_strings()
    {
        $type = Validator::STRING_TYPE;

        $this->assertTrue(Validator::isValid('string', $type));
        $this->assertTrue(Validator::isValid('true', $type));
        $this->assertTrue(Validator::isValid('false', $type));
        $this->assertTrue(Validator::isValid('10', $type));
        $this->assertTrue(Validator::isValid('10.0', $type));

        $this->assertFalse(Validator::isValid(0, $type));
        $this->assertFalse(Validator::isValid(1000, $type));
        $this->assertFalse(Validator::isValid(0.1, $type));
        $this->assertFalse(Validator::isValid(false, $type));
        $this->assertFalse(Validator::isValid(true, $type));
    }

    /** @test */
    public function it_should_validate_floats()
    {
        $type = Validator::FLOAT_TYPE;

        $this->assertTrue(Validator::isValid(0.2, $type));
        $this->assertTrue(Validator::isValid(0.0, $type));
        $this->assertTrue(Validator::isValid(10.0, $type));
        $this->assertTrue(Validator::isValid(5.5, $type));

        $this->assertFalse(Validator::isValid(0, $type));
        $this->assertFalse(Validator::isValid(1000, $type));
        $this->assertFalse(Validator::isValid('0.1', $type));
        $this->assertFalse(Validator::isValid(false, $type));
        $this->assertFalse(Validator::isValid(true, $type));
    }

    /** @test */
    public function it_should_validate_arrays()
    {
        $type = Validator::ARRAY_TYPE;

        $this->assertTrue(Validator::isValid([], $type));
        $this->assertTrue(Validator::isValid(array(), $type));
        $this->assertTrue(Validator::isValid([10.0, 'a'], $type));

        $this->assertFalse(Validator::isValid(0, $type));
        $this->assertFalse(Validator::isValid(1000, $type));
        $this->assertFalse(Validator::isValid('[]', $type));
        $this->assertFalse(Validator::isValid(false, $type));
        $this->assertFalse(Validator::isValid(true, $type));
    }

    /** @test */
    public function it_should_validate_emails()
    {
        $type = Validator::EMAIL;

        $this->assertTrue(Validator::isValid('fdelgados@gmail.com', $type));
        $this->assertTrue(Validator::isValid('fdelgados@gmail.com.es', $type));

        $this->assertFalse(Validator::isValid('@gmail.com', $type));
        $this->assertFalse(Validator::isValid('fdelgadosgmail.com', $type));
    }
}
