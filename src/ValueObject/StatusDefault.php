<?php

namespace CiscoDelgado\Types\ValueObject;

class StatusDefault
{
    const DEFAULT = true;
    const NON_DEFAULT = false;

    /** @var bool */
    protected $value;

    /**
     * @param bool $value
     */
    private function __construct(bool $value)
    {
        $this->value = $value;
    }

    public static function default(): self
    {
        return new static(static::DEFAULT);
    }

    /**
     * @return self
     */
    public static function nonDefault(): self
    {
        return new static(static::NON_DEFAULT);
    }

    /**
     * @return bool
     */
    public function value(): bool
    {
        return $this->value;
    }

    /**
     * @return bool
     */
    public function isDefault(): bool
    {
        return $this->value === self::DEFAULT;
    }

    /**
     * @return bool
     */
    public function isNonDefault(): bool
    {
        return $this->value === self::NON_DEFAULT;
    }
}
