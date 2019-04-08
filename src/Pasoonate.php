<?php

namespace Pasoonate;

use Pasoonate\Calendar\CalendarManager;
use Pasoonate\Formatter\DateFormat;
use Pasoonate\Formatter\SimpleDateFormat;

class Pasoonate extends Constants
{
    /**
     * @var Localization
     */
    public static $localization;

    /**
     * @var Formatter\DateFormat
     */
    public static $formatter;

    public static function make($timestamp = null, $timezoneOffset = null)
    {
        return new CalendarManager($timestamp, $timezoneOffset);
    }

    public static function trans($key, $locale = null)
    {
        return self::$localization->trans($key, $locale);
    }

    public static function setLocale($locale)
    {
        self::$localization->setLocale($locale);
    }

    public static function getLocale()
    {
        return self::$localization->getLocale();
    }

    public static function isLocale($locale)
    {
        return self::$localization->isLocale($locale);
    }

    public static function setFormatter($formatter)
    {
        self::$formatter = $formatter instanceof DateFormat ? $formatter : new SimpleDateFormat();
    }
}

Pasoonate::$localization = new Localization();
Pasoonate::$formatter = new SimpleDateFormat();

Pasoonate::$localization->setLang('fa', include('Lang/fa.php'));