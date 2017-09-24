<?php

namespace CiscoDelgado\Types\ValueObject;

abstract class FloatValueObject extends NumberValueObject
{
    /** @var float */
    protected $value;

    public function __construct(float $value)
    {
        $this->value = $value;
    }
}
