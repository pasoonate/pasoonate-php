<?php

namespace Pasoonate;

use Pasoonate\Calendar\CalendarManager;
use Pasoonate\Formatter\SimpleDateFormat;
use Pasoonate\Formatter\DateFormat;

class Pasoonate extends Constants
{

	public $localization;

	public $formatter;

    public function __construct()
    {
    	$this->localization = new Localization();
    	$this->formatter = new SimpleDateFormat();
    }

    public static function make($timestamp = null, $timezoneOffset = null)
    {
        return new CalendarManager($timestamp, $timezoneOffset);
    }

	public static function trans($key, $locale)
	{
		return $this->localization->trans($key, $locale);
	}

	public static function setLocale($locale)
	{
		$this->localization->setLocale($locale);
	}

	public static function getLocal()
	{
		return $this->localization->getLocal();
	}

	public static function isLocal($locale)
	{
		return $this->localization->isLocal($locale);
	}

	public static function setFormatter($formatter)
	{
		$this->formatter = $formatter instanceof DateFormat ? $formatter : new SimpleDateFormat();
	}   
}