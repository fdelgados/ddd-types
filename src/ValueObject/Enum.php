<?php

namespace CiscoDelgado\Types\ValueObject;

use function CiscoDelgado\CommonUtilities\StringProcessing\snake_to_camel;
use CiscoDelgado\Types\ValueObject\Exception\InvalidEnumValueException;

abstract class Enum
{
    /** @var array */
    protected static $cache = [];

    /** @var mixed */
    protected $value;

    /**
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->guardAgainstInvalidValue($value);
        $this->value = $value;
    }

    /**
     * @param $name
     * @param $arguments
     * @return static
     */
    public static function __callStatic($name, $arguments)
    {
        return new static(self::values()[$name]);
    }

    /**
     * @param mixed $value
     * @return static
     */
    public static function fromValue($value)
    {
        return new static($value);
    }

    /**
     * @return mixed
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * @return array
     */
    public static function values(): array
    {
        $class = static::class;

        if (!isset(self::$cache[$class])) {
            try {
                $reflected = new \ReflectionClass($class);
                self::$cache[$class] = self::getNames($reflected->getConstants());
            } catch (\ReflectionException $exception) {
                return self::$cache[$class];
            }
        }

        return self::$cache[$class];
    }

    /**
     * @param array $constants
     * @return array
     */
    private static function getNames(array $constants): array
    {
        $names = [];
        foreach ($constants as $key => $value) {
            $names[snake_to_camel(strtolower($key))] = $value;
        }

        return $names;
    }

    /**
     * @param mixed $value
     */
    private function guardAgainstInvalidValue($value)
    {
        if (!in_array($value, static::values(), true)) {
            throw new InvalidEnumValueException();
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->value();
    }

    /**
     * @param Enum $enum
     * @return bool
     */
    public function equalsTo(Enum $enum): bool
    {
        return $this->value === $enum->value();
    }
}
