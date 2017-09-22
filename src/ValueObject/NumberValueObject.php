<?php

namespace CiscoDelgado\Types\ValueObject;

abstract class NumberValueObject
{
    /** @var float|int */
    protected $value;

    /**
     * @param NumberValueObject $number
     * @return bool
     */
    public function isBiggerThan(NumberValueObject $number): bool
    {
        return $this->value > $number->value();
    }

    /**
     * @param NumberValueObject $number
     * @return bool
     */
    public function isLowerThan(NumberValueObject $number): bool
    {
        return $this->value() < $number->value();
    }

    /**
     * @return float|int
     */
    public function value()
    {
        return $this->value;
    }
}
