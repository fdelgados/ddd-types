<?php

namespace CiscoDelgado\Types\ValueObject;

use Ramsey\Uuid\Uuid;

final class IdentifierUuid extends Identifier
{
    public function __construct()
    {
        parent::__construct(Uuid::uuid4()->toString());
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->value;
    }
}
