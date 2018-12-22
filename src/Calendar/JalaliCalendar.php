<?php

namespace Pasoonate\Calendar;

class JalaliCalendar extends Calendar
{
    const JalaliEpoch = 1948320.5;

    public function __construct()
    {

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
        $julianDay += $this::JalaliEpoch - 1;

        return $this->addTimeToJulianDay($julianDay, $hour, $minute, $second);
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

        $yday = ($julianDay - $this->julianDayWithoutTime($this->dateToJulianDay($year, 1, 1, $time->hour, $time->minute, $time->second)) + 1;
        $month = ($yday <= 186) ? ceil($yday / 31) : ceil(($yday - 6) / 30);
        $day = ($julianDay - $this->julianDayWithoutTime($this->dateToJulianDay($year, $month, 1, $time->hour, $time->minute, $time->second))) + 1;

        $date = new \stdClass();
        $date->year = $year;
        $date->month = $month;
        $date->day = $day;
        $date->hour = $time->hour;
        $date->minute = $time->minute;
        $date->second = $time->second;
        return $date;
    }

    public function daysInMonth($year, $month)
    {        
        $gregorianDaysInMonth = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29); //30

        if ($month < 1 || $month > 12) {
            throw new RangeException("$month Out Of Range Exception");
        }

        if ($year && $this->isLeap($year) && $month == 12) {
            return 30;
        }

        return $gregorianDaysInMonth[$month - 1];
    }

    public function isLeap($year)
    {
        return (((((($year - (($year > 0) ? 474 : 473)) % 2820) + 474) + 38) * 682) % 2816) < 682;
    }
}