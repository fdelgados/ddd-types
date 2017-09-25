<?php

use CiscoDelgado\Types\ValueObject\StringValueObject;

class StringValueObjectTest extends \PHPUnit_Framework_TestCase
{
    /** @var StringDummy */
    private $dummyString;

    protected function setUp()
    {
        $this->money = $this->createString('Lorem ipsum');
    }

    /**
     * @test
     * @expectedException CiscoDelgado\Types\ValueObject\Exception\EmptyValueException
     */
    public function it_should_not_allow_empty_strings()
    {
        new StringDummy('');
    }

    /** @test */
    public function it_should_be_concatenated()
    {
        $newString = $this->dummyString->concat(new StringDummy('dolor sit amet'));

        $this->assertEquals('Lorem ipsum dolor sit amet', $newString);
    }

    /** @test */
    public function original_string_should_not_be_modified_on_concatenation()
    {
        $this->dummyString->concat(new StringDummy('dolor sit amet'));

        $this->assertEquals('Lorem ipsum', $this->dummyString->value());
    }

    /**
     * @param string $string
     */
    private function createString(string $string)
    {
        $this->dummyString = new StringDummy($string);
    }
}

class StringDummy extends StringValueObject
{
}
