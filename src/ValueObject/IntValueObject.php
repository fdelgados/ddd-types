<?php

namespace CiscoDelgado\Types\ValueObject;

abstract class IntValueObject extends NumberValueObject
{
    /** @var int */
    protected $value;
    /**
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @param IntValueObject $other
     * @return bool
     */
    public function equalsTo(IntValueObject $other): bool
    {
        return $this->value() === $other->value();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->value;
    }
}
