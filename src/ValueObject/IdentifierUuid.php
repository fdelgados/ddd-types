<?php

namespace CiscoDelgado\Types\ValueObject;

use Ramsey\Uuid\Uuid;

class IdentifierUuid extends Identifier
{
    /**
     * @param null|string $id
     */
    public function __construct($id = null)
    {
        $value = $id ?? Uuid::uuid4()->toString();

        parent::__construct($value);
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->value;
    }
}
