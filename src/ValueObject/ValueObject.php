<?php

namespace CiscoDelgado\Types\ValueObject;

interface ValueObject
{
    /**
     * @param ValueObject $valueObject
     * @return bool
     */
    public function equalsTo(ValueObject $valueObject): bool;

    /**
     * @return mixed
     */
    public function value();
}
