<?php

namespace CiscoDelgado\Types\ValueObject;

abstract class NumberValueObject implements ValueObject
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

    /**
     * @param ValueObject $valueObject
     * @return bool
     */
    public function equalsTo(ValueObject $valueObject): bool
    {
        return $this->value === $valueObject->value();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->value();
    }
}
