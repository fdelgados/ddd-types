<?php

namespace CiscoDelgado\Types\ValueObject;

class BooleanValueObject
{
    /** @var bool */
    protected $value;

    /**
     * @param bool $value
     */
    public function __construct(bool $value)
    {
        $this->value = $value;
    }

    /**
     * @return bool
     */
    public function value(): bool
    {
        return $this->value;
    }

    /**
     * @param BooleanValueObject $booleanValueObject
     * @return BooleanValueObject
     */
    public static function negate(BooleanValueObject $booleanValueObject): BooleanValueObject
    {
        return new static(!$booleanValueObject->value());
    }

    /**
     * @return bool
     */
    public function isTrue(): bool
    {
        return $this->value;
    }

    /**
     * @return bool
     */
    public function isFalse(): bool
    {
        return $this->value === false;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value ? '1' : '0';
    }

    /**
     * @param BooleanValueObject $booleanValueObject
     * @return bool
     */
    public function equalsTo(BooleanValueObject $booleanValueObject): bool
    {
        return $this->value === $booleanValueObject->value();
    }
}
