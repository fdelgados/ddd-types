<?php

namespace CiscoDelgado\Types\ValueObject;

final class Currency extends Enum
{
    const EUR = 'EUR';
    const USD = 'USD';
    const GBP = 'GBP';

    private $symbols = [
        self::EUR => [
            'name' => 'Euro',
            'code' => '128'
        ],
        self::USD => [
            'name' => 'US Dollar',
            'code' => '36'
        ],
        self::GBP => [
            'name' => 'British Pound',
            'code' => '163'
        ]
    ];

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->symbols[$this->value()]['name'];
    }

    /**
     * @return string
     */
    public function isoCode(): string
    {
        return $this->value();
    }

    /**
     * @return string
     */
    public function numericCode(): string
    {
        return $this->symbols[$this->value()]['code'];
    }
}
