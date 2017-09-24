<?php

namespace CiscoDelgado\Types\ValueObject;

abstract class FloatValueObject extends NumberValueObject
{
    /**
     * @param float $value
     */
    public function __construct(float $value)
    {
        $this->value = $value;
    }
}
