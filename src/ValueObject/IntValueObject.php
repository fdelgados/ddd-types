<?php

namespace CiscoDelgado\Types\ValueObject;

abstract class IntValueObject extends NumberValueObject
{
    /**
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }
}
