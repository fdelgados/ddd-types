<?php

namespace CiscoDelgado\Types\ValueObject;

use CiscoDelgado\Types\ValueObject\Exception\ValueObjectException;

final class Money implements ValueObject
{
    /** @var float|int */
    private $amount;

    /** @var Currency */
    private $currency;

    /**
     * @param float|int $amount
     * @param Currency $currency
     */
    public function __construct($amount, Currency $currency)
    {
        $this->guardAgainstInvalidValue($amount);
        $this->currency = $currency;
    }

    /**
     * @param float|int $amount
     * @param Currency $currency
     * @return Money
     */
    public static function createNew($amount, Currency $currency): Money
    {
        return new self($amount, $currency);
    }

    /**
     * @param Money $money
     * @return Money
     */
    public static function createFromMoney(Money $money): Money
    {
        return new self($money->amount(), $money->currency());
    }

    /**
     * @param Currency $currency
     * @return Money
     */
    public static function ofCurrency(Currency $currency): Money
    {
        return new self(0, $currency);
    }

    /**
     * @param $amount
     */
    private function guardAgainstInvalidValue($amount)
    {
        if (!is_int($amount) && !is_float($amount)) {
            throw new ValueObjectException(sprintf('%s is no a valid value', $amount));
        }
    }

    /**
     * @return float|int
     */
    public function amount()
    {
        return $this->amount;
    }

    /**
     * @return Currency
     */
    public function currency()
    {
        return $this->currency;
    }

    /**
     * @param int|float $amount
     * @return Money
     */
    public function increaseAmountBy($amount)
    {
        $this->guardAgainstInvalidValue($amount);

        return new self(
            $this->amount() + floatval($amount),
            $this->currency()
        );
    }

    /**
     * @param int|float $amount
     * @return Money
     */
    public function decreaseAmountBy($amount)
    {
        $this->guardAgainstInvalidValue($amount);

        return new self(
            $this->amount() - (float) $amount,
            $this->currency()
        );
    }

    /**
     * @param Money $money
     * @return Money
     */
    public function add(Money $money)
    {
        $this->guardAgainstDistinctCurrency($money->currency());

        return new self(
            $this->amount() + $money->amount(),
            $money->currency()
        );
    }

    /**
     * @param Money $money
     * @return Money
     */
    public function substract(Money $money)
    {
        $this->guardAgainstDistinctCurrency($money->currency());

        return new self(
            $this->amount() - $money->amount(),
            $money->currency()
        );
    }

    /**
     * @param Currency $currency
     */
    private function guardAgainstDistinctCurrency(Currency $currency)
    {
        if (!$this->currency()->equalsTo($currency)) {
            throw new ValueObjectException('Currency is not the same');
        }
    }

    /**
     * @param ValueObject|Money $money
     * @return bool
     */
    public function equalsTo(ValueObject $money): bool
    {
        return
            $this->currency()->equalsTo($money->currency()) &&
            $this->amount() === $money->amount();
    }

    /**
     * @return mixed
     */
    public function value()
    {
        return sprintf('%s %F', $this->currency()->value(), $this->value());
    }
}
