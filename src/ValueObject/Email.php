<?php

namespace CiscoDelgado\Types\ValueObject;

use CiscoDelgado\Types\Assert;
use CiscoDelgado\Types\Exception\AssertionFailedException;
use CiscoDelgado\Types\Validator;
use CiscoDelgado\Types\ValueObject\Exception\ValueObjectException;

final class Email extends StringValueObject
{
    /**
     * @param string $address
     * @throws ValueObjectException
     */
    public function __construct(string $address)
    {
        $this->guardAgainstInvalidMailAddress($address);

        parent::__construct($address);
    }

    /**
     * @return string
     */
    public function address(): string
    {
        return $this->value;
    }

    /**
     * @param string $address
     * @return Email
     * @throws ValueObjectException
     */
    public static function createFromString(string $address): Email
    {
        return new self($address);
    }

    /**
     * @param Email $email
     * @return Email
     * @throws ValueObjectException
     */
    public static function createFromEmail(Email $email): Email
    {
        return new self($email->address());
    }

    /**
     * @param $address
     * @return Email
     * @throws ValueObjectException
     */
    public function modify($address): Email
    {
        return new self($address);
    }

    /**
     * @param string $address
     * @throws ValueObjectException
     */
    private function guardAgainstInvalidMailAddress(string $address)
    {
        if (!Validator::isValid($address, Validator::EMAIL)) {
            throw new ValueObjectException(
                sprintf('<%s> is not a valid email address', $address)
            );
        }
    }

    /**
     * @param ValueObject|Email $email
     * @return bool
     */
    public function equalsTo(ValueObject $email): bool
    {
        try {
            Assert::instanceOf(self::class, $email);
        } catch (AssertionFailedException $exception) {
            return false;
        }

        return $this->address() === $email->address();
    }
}
