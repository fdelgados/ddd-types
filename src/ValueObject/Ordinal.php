<?php

namespace CiscoDelgado\Types\ValueObject;

class Ordinal extends IntValueObject
{
    /**
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->guardAgainstNegativeOrdinal($value);

        parent::__construct($value);
    }

    /**
     * @param int $value
     */
    private function guardAgainstNegativeOrdinal(int $value)
    {
        if ($value < 0) {
            throw new \InvalidArgumentException('Order cannot be negative');
        }
    }
}
