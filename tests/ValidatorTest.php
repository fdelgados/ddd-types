<?php

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

    /** @test */
    public function it_should_validate_urls()
    {
        $type = Validator::URL;

        $this->assertTrue(Validator::isValid('http://www.google.com', $type));
        $this->assertTrue(Validator::isValid('https://www.google.com', $type));
        $this->assertTrue(Validator::isValid('https://google.com', $type));

        $this->assertFalse(Validator::isValid('www.google.com', $type));
    }

    /** @test */
    public function it_should_validate_1pv4_addresses()
    {
        $type = Validator::IPV4_ADDRESS;

        $this->assertTrue(Validator::isValid('192.168.0.1', $type));
        $this->assertTrue(Validator::isValid('0.0.0.0', $type));
        $this->assertTrue(Validator::isValid('255.255.255.255', $type));
        $this->assertTrue(Validator::isValid('88.19.98.1', $type));

        $this->assertFalse(Validator::isValid('88.19.98', $type));
        $this->assertFalse(Validator::isValid('88.19.98,10', $type));
        $this->assertFalse(Validator::isValid('256.19.98.10', $type));
    }

    /** @test */
    public function it_should_validate_required_values()
    {
        $type = Validator::REQUIRED;

        $this->assertTrue(Validator::isValid('lorem ipsum', $type));
        $this->assertTrue(Validator::isValid(10, $type));
        $this->assertTrue(Validator::isValid([1, 3, 4], $type));
        $this->assertTrue(Validator::isValid(0, $type));
        $this->assertTrue(Validator::isValid([], $type));
        $this->assertTrue(Validator::isValid(true, $type));
        $this->assertTrue(Validator::isValid(false, $type));

        $this->assertFalse(Validator::isValid('', $type));
        $this->assertFalse(Validator::isValid(null, $type));
    }

    /** @test */
    public function it_should_validate_null_values()
    {
        $type = Validator::NOT_NULL;

        $this->assertTrue(Validator::isValid(0, $type));
        $this->assertTrue(Validator::isValid(false, $type));
        $this->assertTrue(Validator::isValid('', $type));
        $this->assertTrue(Validator::isValid([], $type));

        $this->assertFalse(Validator::isValid(null, $type));
    }

    /** @test */
    public function it_should_validate_max_length()
    {
        $type = Validator::MAX_LENGTH;

        $this->assertTrue(Validator::isValid('three', $type, 5));
        $this->assertTrue(Validator::isValid('two', $type, 5));
        $this->assertTrue(Validator::isValid(5, $type, 1));

        $this->assertFalse(Validator::isValid('three', $type, 4));
        $this->assertFalse(Validator::isValid(35, $type, 1));
    }

    /** @test */
    public function it_should_validate_min_length()
    {
        $type = Validator::MIN_LENGTH;

        $this->assertTrue(Validator::isValid('three', $type, 5));
        $this->assertTrue(Validator::isValid(5, $type, 1));
        $this->assertTrue(Validator::isValid('three', $type, 4));
        $this->assertTrue(Validator::isValid(3533, $type, 1));

        $this->assertFalse(Validator::isValid('ab', $type, 3));
        $this->assertFalse(Validator::isValid(3533, $type, 5));
    }

    /** @test */
    public function it_should_validate_exact_length()
    {
        $type = Validator::EXACT_LENGTH;

        $this->assertTrue(Validator::isValid('three', $type, 5));

        $this->assertFalse(Validator::isValid('ab', $type, 3));
        $this->assertFalse(Validator::isValid('abcd', $type, 3));
    }

    /** @test */
    public function it_should_validate_if_a_value_is_contained()
    {
        $type = Validator::CONTAINS;

        $this->assertTrue(Validator::isValid(['one', 'two', 'three'], $type, 'one'));

        $this->assertFalse(Validator::isValid(['one', 'two', 'three'], $type, 'four'));
        $this->assertFalse(Validator::isValid('one,two,three', $type, 'one'));
    }

    /** @test */
    public function it_should_validate_if_a_value_is_not_contained()
    {
        $type = Validator::NOT_CONTAINS;

        $this->assertTrue(Validator::isValid(['one', 'two', 'three'], $type, 'four'));

        $this->assertFalse(Validator::isValid(['one', 'two', 'three'], $type, 'one'));
        $this->assertFalse(Validator::isValid('one,two,three', $type, 'one'));
    }

    /** @test */
    public function it_should_validate_regular_expressions()
    {
        $type = Validator::REGEX;
        $regex = '/^foo/';

        $this->assertTrue(Validator::isValid('foo', $type, $regex));
        $this->assertTrue(Validator::isValid('footer', $type, $regex));

        $this->assertFalse(Validator::isValid('bar', $type, $regex));
        $this->assertFalse(Validator::isValid('barfooter', $type, $regex));
    }

    /** @test */
    public function it_should_validate_if_value_is_any_of_an_array()
    {
        $type = Validator::ANY;
        $array = ['lorem', 'ipsum', 'dolor'];

        $this->assertTrue(Validator::isValid('lorem', $type, $array));
        $this->assertTrue(Validator::isValid('ipsum', $type, $array));
        $this->assertTrue(Validator::isValid('dolor', $type, $array));

        $this->assertFalse(Validator::isValid('sit', $type, $array));
    }

    /** @test */
    public function it_should_validate_if_value_is_not_any_of_an_array()
    {
        $type = Validator::NOT_ANY;
        $array = ['lorem', 'ipsum', 'dolor'];

        $this->assertTrue(Validator::isValid('sit', $type, $array));

        $this->assertFalse(Validator::isValid('lorem', $type, $array));
        $this->assertFalse(Validator::isValid('ipsum', $type, $array));
        $this->assertFalse(Validator::isValid('dolor', $type, $array));
    }
}
