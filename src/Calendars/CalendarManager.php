<?php

namespace Pasoonate\Calendars;

use Pasoonate\Formatters\DateFormat;
use Pasoonate\Parsers\Parser;
use Pasoonate\Pasoonate;
use Pasoonate\Traits\AdditionAndSubtraction;
use Pasoonate\Traits\Base;
use Pasoonate\Traits\Comparison;
use Pasoonate\Traits\Difference;
use Pasoonate\Traits\Modifiers;

class CalendarManager
{
    use Base;
    use AdditionAndSubtraction;
    use Difference;
    use Comparison;
    use Modifiers;

    private GregorianCalendar $gregorian;
    private JalaliCalendar $jalali;
    private IslamicCalendar $islamic;
    private ShiaCalendar $shia;
    private Calendar|null $currentCalendar;
    private DateFormat $formatter;
    private Parser $parser;
    private int $timestamp;
    private int $timezoneOffset;

    public function __construct(int|null $timestamp, string|int|null $timezoneOffset)
    {
        $this->gregorian = new GregorianCalendar();
        $this->jalali = new JalaliCalendar();
        $this->islamic = new IslamicCalendar();
        $this->shia = new ShiaCalendar();
        $this->currentCalendar = null;
        $this->formatter = Pasoonate::$formatter;
        $this->parser = Pasoonate::$parser;

        $this->timestamp = $timestamp ?? time();
        $this->timezoneOffset = is_string($timezoneOffset) || $timezoneOffset === null ? $this->getDefaultTimezoneOffset($timezoneOffset) : $timezoneOffset;;
    }

    public function gregorian(string|null $datetime = null): CalendarManager
    {
        $this->currentCalendar = $this->gregorian;

        if ($datetime) {
            $this->parse('yyyy-MM-dd HH:mm:ss', $datetime);
        }

        return $this;
    }

    public function jalali(string|null $datetime = null): CalendarManager
    {
        $this->currentCalendar = $this->jalali;

        if ($datetime) {
            $this->parse('yyyy/MM/dd HH:mm:ss', $datetime);
        }

        return $this;
    }

    public function islamic(string|null $datetime = null): CalendarManager
    {
        $this->currentCalendar = $this->islamic;

        if ($datetime) {
            $this->parse('yyyy-MM-dd HH:mm:ss', $datetime);
        }

        return $this;
    }

    public function shia(string|null $datetime = null): CalendarManager
    {
        $this->currentCalendar = $this->shia;

        if ($datetime) {
            $this->parse('yyyy-MM-dd HH:mm:ss', $datetime);
        }

        return $this;
    }

    public function name(string|null $calendar = null): string
    {
        if ($calendar) {
            $calendar = strtolower($calendar);
            $instance = $this->$calendar ?? null;

            if ($instance) {
                $this->currentCalendar = $instance;
            }

            return '';
        }

        return $this->currentCalendar ? $this->currentCalendar->getName() : '';
    }

    public function parse(string $pattern, string $text): CalendarManager
    {
        $this->parser->setCalendar($this);

        $this->parser->parse($pattern, $text);

        return $this;
    }

    public function format(string $pattern, string|null $locale = null): string
    {
        $this->formatter->setCalendar($this);

        return $this->formatter->format($pattern, $locale ?? Pasoonate::getLocale());
    }

    public function clone(): CalendarManager
    {
        return Pasoonate::make($this->getTimestamp(), $this->getTimezoneOffset());
    }

    private function getDefaultTimezoneOffset(string|null $timezoneString = null): int
    {
        $timezoneString = $timezoneString ?? date_default_timezone_get();
        $timezone = timezone_open($timezoneString);

        return timezone_offset_get($timezone, date_create());
    }

}