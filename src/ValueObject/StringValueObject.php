<?php

namespace CiscoDelgado\Types\ValueObject;

use CiscoDelgado\Types\ValueObject\Exception\EmptyValueException;

abstract class StringValueObject implements ValueObject
{
    /** @var string */
    protected $value;

    /**
     * @param $value
     */
    public function __construct(string $value)
    {
        $this->guardAgainstEmtpyValue($value);

        $this->value = $value;
    }

    /**
     * @param string $value
     */
    private function guardAgainstEmtpyValue(string $value)
    {
        if (empty($value)) {
            throw new EmptyValueException();
        }
    }

    /**
     * @param StringValueObject $stringValueObject
     * @param string $glue
     * @return StringValueObject
     */
    public function concat(StringValueObject $stringValueObject, string $glue = ' '): self
    {
        return new static(
            sprintf('%s%s%s', $this->value, $glue, $stringValueObject->value())
        );
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value();
    }

    /**
     * @inheritdoc
     */
    public function equalsTo(ValueObject $stringValueObject): bool
    {
        return $this->value() === $stringValueObject->value();
    }
}
