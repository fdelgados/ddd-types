<?php

namespace CiscoDelgado\Types\Aggregate;

abstract class AggregateValidator
{
    /**
     * @param AggregateRoot $aggregateRoot
     * @return bool
     */
    public function isValid(AggregateRoot $aggregateRoot)
    {
        return count($this->brokenRules($aggregateRoot)) === 0;
    }

    /**
     * @param AggregateRoot $aggregateRoot
     * @return array
     */
    abstract protected function brokenRules(AggregateRoot $aggregateRoot);
}
