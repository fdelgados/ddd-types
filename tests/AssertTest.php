<?php

use CiscoDelgado\Types\Assert;

class AssertTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException CiscoDelgado\Types\Exception\AssertionFailedException
     */
    public function it_should_complaint_if_asserts_that_false_is_true()
    {
        Assert::isTrue(1 === 0);
    }

    /**
     * @test
     * @expectedException CiscoDelgado\Types\Exception\AssertionFailedException
     */
    public function it_should_complaint_if_asserts_that_true_is_false()
    {
        Assert::isFalse(1 === 1);
    }

    /**
     * @test
     * @expectedException CiscoDelgado\Types\Exception\AssertionFailedException
     */
    public function it_should_complaint_if_array_members_are_of_different_classes()
    {
        Assert::arrayOf(DummyClass::class, [new DummyClass(), new AnotherDummyClass()]);
    }

    /**
     * @test
     * @expectedException CiscoDelgado\Types\Exception\AssertionFailedException
     */
    public function it_should_complaint_if_object_are_of_different_classes()
    {
        Assert::instanceOf(DummyClass::class, new AnotherDummyClass());
    }

    /**
     * @test
     * @expectedException CiscoDelgado\Types\Exception\AssertionFailedException
     */
    public function it_should_complaint_if_not_belongs_to_array()
    {
        Assert::inArray(['one' => 1, 'two' => 2], 'three');
    }
}

class DummyClass
{
}

class AnotherDummyClass
{
}
