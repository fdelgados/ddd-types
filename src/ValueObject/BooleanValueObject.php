<?php

namespace CiscoDelgado\Types\ValueObject;

use CiscoDelgado\Types\Assert;
use CiscoDelgado\Types\Exception\AssertionFailedException;

class BooleanValueObject implements ValueObject
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
     * @return BooleanValueObject
     */
    public function opposite(): BooleanValueObject
    {
        return new static(!$this->value);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value ? '1' : '0';
    }

    /**
     * @inheritdoc
     */
    public function equalsTo(ValueObject $booleanValueObject): bool
    {
        try {
            Assert::instanceOf(self::class, $booleanValueObject);
        } catch (AssertionFailedException $exception) {
            return false;
        }

        return $this->value === $booleanValueObject->value();
    }
}
