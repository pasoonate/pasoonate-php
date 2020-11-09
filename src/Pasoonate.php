<?php

namespace Pasoonate;

use Pasoonate\Calendars\CalendarManager;
use Pasoonate\Formatters\DateFormat;
use Pasoonate\Formatters\SimpleDateFormat;
use Pasoonate\Parsers\Parser;
use Pasoonate\Parsers\SimpleParser;

class Pasoonate extends Constants
{
    /**
     * @var Localization
     */
    public static $localization;

    /**
     * @var DateFormat
     */
    public static $formatter;

    /**
     * @var Parser
     */
    public static $parser;

    /**
     * @param int|null $timestamp
     * @param int|null $timezoneOffset
     * 
     * @return CalendarManager
     */
    public static function make($timestamp = null, $timezoneOffset = null)
    {
        return new CalendarManager($timestamp, $timezoneOffset);
    }

    public static function trans($key, $locale = null)
    {
        return Pasoonate::$localization->trans($key, $locale);
    }

    public static function setLocale($locale)
    {
        Pasoonate::$localization->setLocale($locale);
    }

    public static function getLocale()
    {
        return Pasoonate::$localization->getLocale();
    }

    public static function isLocale($locale)
    {
        return Pasoonate::$localization->isLocale($locale);
    }

    /**
     * @param DateFormat $formatter
     */
    public static function setFormatter($formatter)
    {
        Pasoonate::$formatter = $formatter instanceof DateFormat ? $formatter : new SimpleDateFormat();
    }

    /**
     * @param Parser $parser
     */
    public static function setParser($parser)
    {
        Pasoonate::$parser = $parser instanceof Parser ? $parser : new SimpleParser();
    }

    /**
     * @param CalendarManager $instance
     * 
     * @return CalendarManager
     */
    public static function clone(CalendarManager $instance)
    {
        return Pasoonate::make($instance->getTimestamp(), $instance->getTimezoneOffset());
    }
}

Pasoonate::$localization = new Localization();
Pasoonate::$formatter = new SimpleDateFormat();
Pasoonate::$parser = new SimpleParser();

Pasoonate::$localization->setLang('fa', include('Lang/fa.php'));