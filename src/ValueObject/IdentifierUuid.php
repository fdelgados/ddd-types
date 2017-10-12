<?php

namespace CiscoDelgado\Types\ValueObject;

use CiscoDelgado\Types\Validator;
use CiscoDelgado\Types\ValueObject\Exception\ValueObjectException;
use Ramsey\Uuid\Uuid;

final class IdentifierUuid extends Identifier
{
    /**
     * @param string|null $id
     */
    public function __construct(string $id = null)
    {
        if ($id === null) {
            $id = Uuid::uuid4()->toString();
        }

        $this->guardAgainstInvalidUuid($id);

        parent::__construct($id);
    }

    /**
     * @param string $id
     */
    private function guardAgainstInvalidUuid(string $id)
    {
        if (!Validator::isValid($id, Validator::UUID)) {
            throw new ValueObjectException(
                sprintf('<%s> is not a valid UUID identifier', $id)
            );
        }
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->value;
    }
}
