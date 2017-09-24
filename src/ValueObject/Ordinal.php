<?php

namespace CiscoDelgado\Types\ValueObject;

use CiscoDelgado\Types\ValueObject\Exception\ValueObjectException;

final class Ordinal extends IntValueObject
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
            throw new ValueObjectException('Order cannot be negative');
        }
    }

    /**
     * @inheritdoc
     */
    public function equalsTo(ValueObject $valueObject): bool
    {
        return $this->value === $valueObject->value();
    }
}
