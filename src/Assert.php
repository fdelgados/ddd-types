<?php

namespace CiscoDelgado\Types;

use CiscoDelgado\Types\Exception\AssertionFailedException;

final class Assert
{
    /**
     * @param bool $condition
     * @param string $message
     * @throws AssertionFailedException
     */
    public static function isTrue(bool $condition, string $message = '')
    {
        if ($condition !== true) {
            throw new AssertionFailedException(
                empty($message) ? 'Failed asserting that false is true' : $message
            );
        }
    }

    /**
     * @param bool $condition
     * @param string $message
     * @throws AssertionFailedException
     */
    public static function isFalse(bool $condition, string $message = '')
    {
        if ($condition !== false) {
            throw new AssertionFailedException(
                empty($message) ? 'Failed asserting that true is false' : $message
            );
        }
    }

    /**
     * @param $class
     * @param array $items
     * @throws AssertionFailedException
     */
    public static function arrayOf($class, array $items)
    {
        foreach ($items as $item) {
            self::instanceOf($class, $item);
        }
    }

    /**
     * @param $class
     * @param $item
     * @throws AssertionFailedException
     */
    public static function instanceOf($class, $item)
    {
        if (!$item instanceof $class) {
            throw new AssertionFailedException(
                sprintf('The object <%s> is not an instance of <%s>', get_class($item), $class)
            );
        }
    }

    /**
     * @param array $array
     * @param $key
     * @throws AssertionFailedException
     */
    public static function inArray(array $array, $key)
    {
        if (!isset($array[$key])) {
            throw new AssertionFailedException(
                sprintf('Key <%s> does not exist in the array', $key)
            );
        }
    }
}
