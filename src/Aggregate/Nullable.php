<?php

namespace CiscoDelgado\Types\Aggregate;

interface Nullable
{
    /**
     * @return bool
     */
    public function isNull(): bool;
}
