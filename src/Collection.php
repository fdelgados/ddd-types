<?php

namespace CiscoDelgado\Types;

use Doctrine\Common\Collections\ArrayCollection;
use CiscoDelgado\Types\Exception\AssertionFailedException;
use CiscoDelgado\Types\Exception\InvalidTypeInCollectionException;

abstract class Collection extends ArrayCollection
{
    /**
     * @param array $elements
     */
    public function __construct(array $elements = [])
    {
        try {
            Assert::arrayOf($this->type(), $elements);
        } catch (AssertionFailedException $exception) {
            throw new InvalidTypeInCollectionException($exception->getMessage());
        }

        parent::__construct($elements);
    }

    /**
     * @return string
     */
    abstract public function type(): string;

    /**
     * @param mixed $element
     * @return bool
     */
    public function add($element)
    {
        try {
            Assert::instanceOf($this->type(), $element);

            return parent::add($element);
        } catch (AssertionFailedException $exception) {
            throw new InvalidTypeInCollectionException($exception->getMessage());
        }
    }
}
