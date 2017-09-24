<?php

use CiscoDelgado\Types\ValueObject\Currency;
use CiscoDelgado\Types\ValueObject\Money;

class MoneyTest extends \PHPUnit_Framework_TestCase
{
    /** @var Money */
    private $money;

    protected function setUp()
    {
        $this->money = $this->createMoney(10, 'EUR');
    }

    /** @test */
    public function copied_money_should_represent_same_value()
    {
        $copiedMoney = Money::createFromMoney($this->money);

        $this->assertTrue($this->money->equalsTo($copiedMoney));
    }

    /** @test */
    public function it_should_not_modify_original_value_on_addition()
    {
        $this->money->add($this->createMoney(10, 'EUR'));

        $this->assertEquals(10, $this->money->amount());
    }

    /** @test */
    public function it_should_add_money()
    {
        $money = $this->money->add($this->createMoney(10, 'EUR'));

        $this->assertEquals(20, $money->amount());
    }

    /** @test */
    public function it_should_subtract_money()
    {
        $money = $this->money->subtract($this->createMoney(5, 'EUR'));

        $this->assertEquals(5, $money->amount());
    }

    /**
     * @test
     * @expectedException CiscoDelgado\Types\ValueObject\Exception\ValueObjectException
     */
    public function it_should_complaint_with_wrong_types()
    {
        $this->createMoney('1', 'EUR');
    }

    /**
     * @param $amount
     * @param string $currencyIsoCode
     * @return Money
     */
    private function createMoney($amount, string $currencyIsoCode): Money
    {
        return new Money($amount, new Currency($currencyIsoCode));
    }
}
