<?php

namespace CiscoDelgado\Types;

final class Validator
{
    const STRING_TYPE = 'string';
    const FLOAT_TYPE = 'float';
    const INTEGER_TYPE = 'integer';
    const ARRAY_TYPE = 'array';
    const EMAIL = 'email';
    const URL = 'url';
    const IPV4_ADDRESS = 'ipv4_address';
    const REQUIRED = 'required';
    const NOT_NULL = 'not_null';
    const MAX_LENGTH = 'max_length';
    const MIN_LENGTH = 'min_length';
    const EXACT_LENGTH = 'exact_length';
    const CONTAINS = 'contains';
    const NOT_CONTAINS = 'not_contains';
    const REGEX = 'regex';
    const ANY = 'any';
    const NOT_ANY = 'not_any';
    const UUID = 'uuid';

    /**
     * @param mixed $value
     * @param string $type
     * @param array $arguments
     * @return bool
     */
    public static function isValid($value, string $type, ...$arguments): bool
    {
        $validator = static::validatorFor($type);

        return $validator($value, ...$arguments);
    }

    /**
     * @param string $type
     * @return \Closure
     */
    protected static function validatorFor(string $type): \Closure
    {
        $validators = [
            self::STRING_TYPE => self::stringValidator(),
            self::INTEGER_TYPE => self::intValidator(),
            self::FLOAT_TYPE => self::floatValidator(),
            self::ARRAY_TYPE => self::arrayValidator(),
            self::EMAIL => self::emailValidator(),
            self::URL => self::urlValidator(),
            self::IPV4_ADDRESS => self::ipv4AddressValidator(),
            self::REQUIRED => self::requiredValidator(),
            self::NOT_NULL => self::notNullValidator(),
            self::MAX_LENGTH => self::maxLengthValidator(),
            self::MIN_LENGTH => self::minLengthValidator(),
            self::EXACT_LENGTH => self::exactLengthValidator(),
            self::CONTAINS => self::containsValidator(),
            self::NOT_CONTAINS => self::notContainsValidator(),
            self::REGEX => self::regexValidator(),
            self::ANY => self::anyValidator(),
            self::NOT_ANY => self::notAnyValidator(),
            self::UUID => self::uuidValidator(),
        ];

        return $validators[$type];
    }

    /**
     * @return \Closure
     */
    private static function stringValidator(): \Closure
    {
        return function ($value) {
            return is_string($value);
        };
    }

    /**
     * @return \Closure
     */
    private static function intValidator(): \Closure
    {
        return function ($value) {
            return is_int($value);
        };
    }

    /**
     * @return \Closure
     */
    private static function arrayValidator(): \Closure
    {
        return function ($value) {
            return is_array($value);
        };
    }

    /**
     * @return \Closure
     */
    private static function floatValidator(): \Closure
    {
        return function ($value) {
            return is_float($value);
        };
    }

    /**
     * @return \Closure
     */
    private static function emailValidator(): \Closure
    {
        return function ($value) {
            return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
        };
    }

    /**
     * @return \Closure
     */
    private static function ipv4AddressValidator(): \Closure
    {
        return function ($value) {
            return filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false;
        };
    }

    /**
     * @return \Closure
     */
    private static function urlValidator(): \Closure
    {
        return function ($value) {
            return filter_var($value, FILTER_VALIDATE_URL) !== false;
        };
    }

    /**
     * @return \Closure
     */
    private static function requiredValidator(): \Closure
    {
        return function ($value) {
            if ($value === null) {
                return false;
            }

            if (is_int($value) || is_float($value) || is_array($value) || is_bool($value)) {
                return true;
            }

            return !empty($value);
        };
    }

    /**
     * @return \Closure
     */
    private static function notNullValidator(): \Closure
    {
        return function ($value) {
            return $value !== null;
        };
    }

    /**
     * @return \Closure
     */
    private static function maxLengthValidator(): \Closure
    {
        return function ($value, $maxLength) {
            return strlen($value) <= $maxLength;
        };
    }

    /**
     * @return \Closure
     */
    private static function minLengthValidator(): \Closure
    {
        return function ($value, $minLength) {
            return strlen($value) >= $minLength;
        };
    }

    /**
     * @return \Closure
     */
    private static function exactLengthValidator(): \Closure
    {
        return function ($value, $length) {
            return strlen($value) === $length;
        };
    }

    /**
     * @return \Closure
     */
    private static function containsValidator(): \Closure
    {
        return function ($haystack, $needle) {
            return is_array($haystack) && in_array($needle, $haystack);
        };
    }

    /**
     * @return \Closure
     */
    private static function notContainsValidator(): \Closure
    {
        return function ($haystack, $needle) {
            return is_array($haystack) && !in_array($needle, $haystack);
        };
    }

    /**
     * @return \Closure
     */
    private static function regexValidator(): \Closure
    {
        return function ($subject, $pattern) {
            return preg_match($pattern, $subject) === 1;
        };
    }

    /**
     * @return \Closure
     */
    private static function anyValidator(): \Closure
    {
        return function ($value, $haystack) {
            return is_array($haystack) && in_array($value, $haystack);
        };
    }

    /**
     * @return \Closure
     */
    private static function notAnyValidator(): \Closure
    {
        return function ($value, $haystack) {
            return is_array($haystack) && !in_array($value, $haystack);
        };
    }

    /**
     * @return \Closure
     */
    private static function uuidValidator(): \Closure
    {
        return function ($value) {
            return preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', $value) === 1;
        };
    }
}
