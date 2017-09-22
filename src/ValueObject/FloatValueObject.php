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

    /**
     * @param FloatValueObject $anotherValue
     * @return bool
     */
    abstract public function equalsTo(FloatValueObject $anotherValue): bool;
}
