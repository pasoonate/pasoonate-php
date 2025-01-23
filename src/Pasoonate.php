<?php

namespace Pasoonate;

use Pasoonate\Calendars\CalendarManager;
use Pasoonate\Formatters\DateFormat;
use Pasoonate\Formatters\SimpleDateFormat;
use Pasoonate\Parsers\Parser;
use Pasoonate\Parsers\SimpleParser;

class Pasoonate extends Constants
{
    public static Localization $localization;

    public static DateFormat $formatter;

    public static Parser $parser;

    public static function make(int|null $timestamp = null, string|int|null $timezoneOffset = null): CalendarManager
    {
        return new CalendarManager($timestamp, $timezoneOffset);
    }

    public static function trans(string $key, $locale = null): string
    {
        return Pasoonate::$localization->trans($key, $locale);
    }

    public static function setLocale(string $locale): void
    {
        Pasoonate::$localization->setLocale($locale);
    }

    public static function getLocale(): string
    {
        return Pasoonate::$localization->getLocale();
    }

    public static function isLocale($locale): bool
    {
        return Pasoonate::$localization->isLocale($locale);
    }

    public static function setFormatter(DateFormat|null $formatter): void
    {
        Pasoonate::$formatter = $formatter instanceof DateFormat ? $formatter : new SimpleDateFormat();
    }

    public static function setParser(Parser|null $parser): void
    {
        Pasoonate::$parser = $parser instanceof Parser ? $parser : new SimpleParser();
    }

    public static function clone(CalendarManager $instance): CalendarManager
    {
        return Pasoonate::make($instance->getTimestamp(), $instance->getTimezoneOffset());
    }
}

Pasoonate::$localization = new Localization();
Pasoonate::$formatter = new SimpleDateFormat();
Pasoonate::$parser = new SimpleParser();

Pasoonate::$localization->setLang('fa', include('Lang/fa.php'));