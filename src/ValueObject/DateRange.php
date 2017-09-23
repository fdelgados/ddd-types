<?php

namespace CiscoDelgado\Types\ValueObject;

use CiscoDelgado\Types\ValueObject\Exception\InvalidDataRangeValuesException;

class DateRange
{
    /**
     * @var string
     */
    const MIN = '1970-01-01 00:00:00';

    /**
     * @var string
     */
    const MAX = '2099-12-31 23:59:59';

    /**
     * @var \DateTime
     */
    protected $start;

    /**
     * @var \DateTime
     */
    protected $end;

    /**
     * @param \DateTime $start
     * @param \DateTime $end
     * @throws InvalidDataRangeValuesException
     */
    public function __construct(\DateTime $start, \DateTime $end)
    {
        if ($start > $end) {
            throw new InvalidDataRangeValuesException(
                'The start date should not be later than the end date'
            );
        }

        $this->start = $start;
        $this->end = $end;
    }

    /**
     * @param DateRange $dateRange
     * @return DateRange
     * @throws InvalidDataRangeValuesException
     */
    public static function createFromDateRange(DateRange $dateRange): DateRange
    {
        return new static($dateRange->start(), $dateRange->end());
    }

    /**
     * @param  \DateTime $from
     * @return DateRange
     * @throws InvalidDataRangeValuesException
     */
    public static function from(\DateTime $from): DateRange
    {
        return new static($from, new \DateTime(self::MAX));
    }

    /**
     * @param  \DateTime $until
     * @return DateRange
     * @throws InvalidDataRangeValuesException
     */
    public static function until(\DateTime $until): DateRange
    {
        return new static(new \DateTime(self::MIN), $until);
    }

    /**
     * @return DateRange
     * @throws InvalidDataRangeValuesException
     */
    public static function infinite(): DateRange
    {
        return new static(new \DateTime(self::MIN), new \DateTime(self::MAX));
    }

    /**
     * @param  DateRange $dateRange
     * @return bool
     */
    public function equalsTo(DateRange $dateRange): bool
    {
        return $this->toString() === $dateRange->toString();
    }

    /**
     * @return \DateTime
     */
    public function start(): \DateTime
    {
        return $this->start;
    }

    /**
     * @return \DateTime
     */
    public function end(): \DateTime
    {
        return $this->end;
    }

    /**
     * @param  string $format
     * @param  string $datesSeparator
     * @return string
     */
    public function toString($format = \DateTime::ATOM, $datesSeparator = '-'): string
    {
        return sprintf(
            '%s %s %s',
            $this->start()->format($format),
            $datesSeparator,
            $this->end()->format($format)
        );
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }
}
