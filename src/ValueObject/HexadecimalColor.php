<?php

namespace CiscoDelgado\Types\ValueObject;

use CiscoDelgado\Types\Validator;
use CiscoDelgado\Types\ValueObject\Exception\ValueObjectException;

class HexadecimalColor
{
    /** @var string */
    protected $value;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->guardAgainstInvalidColorReference($value);

        $this->value = $value;
    }

    /**
     * @param string $value
     */
    private function guardAgainstInvalidColorReference(string $value)
    {
        if (!Validator::isValid($value, Validator::HEX_COLOR)) {
            throw new ValueObjectException('Incorrect color reference');
        }
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * @param HexadecimalColor $color
     * @return bool
     */
    public function equalsTo(HexadecimalColor $color): bool
    {
        return $color->value() === $this->value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }
}
