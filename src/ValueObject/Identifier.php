<?php

namespace CiscoDelgado\Types\ValueObject;

use CiscoDelgado\Types\ValueObject\Exception\ValueObjectException;

class Identifier extends StringValueObject
{
    /**
     * @param int|string $id
     * @throws \InvalidArgumentException
     */
    public function __construct($id)
    {
        $this->guardAgainstInvalidId($id);

        parent::__construct((string) $id);
    }

    /**
     * @param $id
     * @throws ValueObjectException
     */
    private function guardAgainstInvalidId($id)
    {
        if (!$this->isValid($id)) {
            throw new ValueObjectException(
                sprintf(
                    '<%s> does not allow the identifier <%s>.',
                    static::class,
                    is_scalar($id) ? $id : gettype($id)
                )
            );
        }
    }

    /**
     * @param mixed $id
     * @return bool
     */
    private function isValid($id): bool
    {
        return is_int($id) || is_string($id);
    }

    /**
     * @param StringValueObject $stringValueObject
     * @return bool
     */
    public function equalsTo(StringValueObject $stringValueObject): bool
    {
        return $this->value === $stringValueObject->value();
    }
}
