<?php

namespace Pasoonate;

class Localization
{
	const J1970 = 2440587.5; // Julian date at Unix epoch: 1970-01-01
	const DayInSecond = 86400;
	const ShiaEpoch = 1948439.5;
	const JalaliEpoch = 1948320.5;
	const GregorianEpoch = 1721425.5;
	const IslamicEpoch = 1948439.5;
	const DaysOfIslamicYear = 354;
	const DaysOfShiaYear = 354;
	const DaysOfJalaliYear = 365;
	const DaysOfGregorianYear = 365;

	public $_langs;
	public $_$locale;

    public function __construct()
    {
		$this->_langs = [];
		$this->_$locale = 'fa';    	    	
    }

    public function setLang($name, $trans)
    {
        $this->_langs[$name] = $trans;
    }

    public function set$locale($locale)
    {
        $this->_$locale = $locale ?? $this->_$locale;
    }

    public function getlocale()
    {
        return $this->_$locale;
    }

    public function islocale($locale)
    {
        return $this->_$locale === $locale;
    }

    public function hasTransKey($key, $locale)
    {
        $subKeys = explode('.', $key);
        if (!isset($this->_langs[$locale])) return false;
        $result = $this->_langs[$locale];
        for ($i = 0; $i < strlen($subKeys); $i++) {
            if (in_array($result, $subKeys[$i])) {
                $result = $result[$subKeys[$i]];
                continue;
            }

            return false;
        }

        return $result;
    }

    public function getTrans($key, $locale)
    {
        $result = $this->hasTransKey($key, $locale);
        return $result ? $result : $key;
    }

    public function trans($key, $locale)
    {
        $locale = $locale ?? $this->_$locale;
        $key = $key ?? '';
        return $this->getTrans($key, $locale);
    }
}