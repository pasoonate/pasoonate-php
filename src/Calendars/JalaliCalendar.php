<?php

namespace Pasoonate\Calendars;

use OutOfRangeException;
use Pasoonate\Constants;
use Pasoonate\DateTime;

class JalaliCalendar extends Calendar
{
    public function __construct()
    {
        parent::__construct('jalali');
    }

    public function julianDayToDate($julianDay)
    {
        $time = $this->extractJulianDayTime($julianDay);

        $julianDay = $this->julianDayWithoutTime($julianDay);

        $julianDay = floor($julianDay) + 0.5;

        $depoch = $julianDay - $this->julianDayWithoutTime($this->dateToJulianDay(475, 1, 1, $time->hour, $time->minute, $time->second));
        $cycle = floor($depoch / 1029983);
        $cyear = $this->mod($depoch, 1029983);
        $ycycle = null;
        $aux1 = null;
        $aux2 = null;

        if($cyear == 339309) {
            $cyear--;
        }

        if ($cyear == 1029982) {
            $ycycle = 2820;
        } else {
            $aux1 = floor($cyear / 366);
            $aux2 = $this->mod($cyear, 366);
            $ycycle = floor(((2134 * $aux1) + (2816 * $aux2) + 2815) / 1028522) + $aux1 + 1;
        }

        $year = $ycycle + (2820 * $cycle) + 474;

        if ($year <= 0) {
            $year--;
        }

        $yday = ($julianDay - $this->julianDayWithoutTime($this->dateToJulianDay($year, 1, 1, $time->hour, $time->minute, $time->second))) + 1;
        $month = ($yday <= 186) ? ceil($yday / 31) : ceil(($yday - 6) / 30);
        $day = ($julianDay - $this->julianDayWithoutTime($this->dateToJulianDay($year, $month, 1, $time->hour, $time->minute, $time->second))) + 1;

        $datetime = new DateTime($year, $month, $day, $time->hour, $time->minute, $time->second);

        return $datetime;
    }

    public function dateToJulianDay($year, $month, $day, $hour, $minute, $second)
    {
        $epochBase = $year - (($year >= 0) ? 474 : 473);
        $epochYear = 474 + $this->mod($epochBase, 2820);
        $julianDay = $day;

        $julianDay += $month <= 7 ? ($month - 1) * 31 : (($month - 1) * 30) + 6;
        $julianDay += floor((($epochYear * 682) - 110) / 2816);
        $julianDay += ($epochYear - 1) * 365;
        $julianDay += floor($epochBase / 2820) * 1029983;
        $julianDay += Constants::JALALI_EPOCH - 1;

        return $this->addTimeToJulianDay($julianDay, $hour, $minute, $second);
    }

    public function daysInMonth($year, $month)
    {
        $gregorianDaysInMonth = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29); //30

        if ($month < 1 || $month > 12) {
            throw new OutOfRangeException("$month Out Of Range Exception");
        }

        if ($year && $this->isLeap($year) && $month == 12) {
            return 30;
        }

        return $gregorianDaysInMonth[$month - 1];
    }

    public function isLeap($year)
    {
        $validRemainValueAfter1343 = [1,5,9,13,17,22,26,30];
        $validRemainValueBefore1343 = [1,5,9,13,17,21,26,30];

        $remain = $year % 33;

	    return $year < 1343 ? in_array($remain, $validRemainValueBefore1343) : in_array($remain, $validRemainValueAfter1343);
    }
}