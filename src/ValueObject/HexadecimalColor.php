<?php

namespace CiscoDelgado\Types\ValueObject;

use CiscoDelgado\Types\Validator;
use CiscoDelgado\Types\ValueObject\Exception\ValueObjectException;

final class HexadecimalColor implements ValueObject
{
    const VALUE_PATTERN = '/^#([A-Fa-f0-9]{6})$/';

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
        if (!Validator::isValid($value, Validator::REGEX, self::VALUE_PATTERN)) {
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
     * @inheritdoc
     */
    public function equalsTo(ValueObject $color): bool
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
