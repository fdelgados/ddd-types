<?php

namespace CiscoDelgado\Types\Tests;

use CiscoDelgado\Types\Collection;

class CollectionTest extends \PHPUnit_Framework_TestCase
{
    /** @var array */
    private $types;

    /** @var ATypeCollection */
    private $typesCollection;

    public function setUp()
    {
        $this->types = [
            new AType('A'),
            new AType('B'),
            new AType('C'),
        ];

        $this->typesCollection = new ATypeCollection($this->types);
    }

    /**
     * @test
     * @expectedException CiscoDelgado\Types\Exception\InvalidTypeInCollectionException
     */
    public function it_should_not_accept_elements_of_different_types()
    {
        $this->types[] = new AnotherType();
        new ATypeCollection($this->types);
    }

    /**
     * @test
     * @expectedException CiscoDelgado\Types\Exception\InvalidTypeInCollectionException
     */
    public function it_should_not_add_elements_of_different_types()
    {
        $this->typesCollection->add(new AnotherType());
    }

    /** @test */
    public function an_element_should_exist()
    {
        $exitst = function ($key, $element) {
            return $element === $this->types[2];
        };

        $this->assertTrue(
            $this->typesCollection->exists($exitst)
        );
    }

    /** @test */
    public function it_should_return_the_first_element()
    {
        $first = $this->typesCollection->first();

        $this->assertInstanceOf(AType::class, $first);
        $this->assertEquals($this->types[0]->name(), $first->name());
    }

    /** @test */
    public function it_should_return_the_last_element()
    {
        $last = $this->typesCollection->last();

        $this->assertInstanceOf(AType::class, $last);
        $this->assertEquals($this->types[2]->name(), $last->name());
    }

    /** @test */
    public function it_should_delete_an_element()
    {
        $this->typesCollection->remove(1);
        $this->assertEquals(2, $this->typesCollection->count());
    }
}

class ATypeCollection extends Collection
{
    /**
     * @return string
     */
    public function type(): string
    {
        return AType::class;
    }
}

class AType
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function name()
    {
        return $this->name;
    }

    public function setName($newName)
    {
        $this->name = $newName;
    }
}

class AnotherType
{
}
