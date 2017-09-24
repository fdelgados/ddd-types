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
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->value;
    }
}
