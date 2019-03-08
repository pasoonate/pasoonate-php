<?php

namespace Pasoonate\Calendar;

class GregorianCalendar extends Calendar
{
    const GregorianEpoch = 1721425.5;

    public function __construct()
    {
        $this->name = 'gregorian';
    }

    public function julianDayToDate($julianDay)
    {
        $time = $this->extractJulianDayTime($julianDay);

        $julianDay = $this->julianDayWithoutTime($julianDay);

        $wjd = floor($julianDay - 0.5) + 0.5;
        $depoch = $wjd - $this::GregorianEpoch;
        $quadricent = floor($depoch / 146097);
        $dqc = $this->mod($depoch, 146097);
        $cent = floor($dqc / 36524);
        $dcent = $this->mod($dqc, 36524);
        $quad = floor($dcent / 1461);
        $dquad = $this->mod($dcent, 1461);
        $yindex = floor($dquad / 365);
        $year = ($quadricent * 400) + ($cent * 100) + ($quad * 4) + $yindex;
        if (!(($cent == 4) || ($yindex == 4))) {
            $year++;
        }

        $yearday = $wjd - $this->julianDayWithoutTime($this->dateToJulianDay($year, 1, 1, $time->hour, $time->minute, $time->second));
        $leapadj = ($wjd < $this->julianDayWithoutTime($this->dateToJulianDay($year, 3, 1, $time->hour, $time->minute, $time->second))) ? 0 : ($this->isLeap($year)) ? 1 : 2;
        $month = floor(((($yearday + $leapadj) * 12) + 373) / 367);
        $day = $wjd - $this->julianDayWithoutTime($this->dateToJulianDay($year, $month, 1, $time->hour, $time->minute, $time->second)) + 1;

        $date = new \stdClass();
        $date->year = $year;
        $date->month = $month;
        $date->day = $day;
        $date->hour = $time->hour;
        $date->minute = $time->minute;
        $date->second = $time->second;
        return $date;
    }

    public function dateToJulianDay($year, $month, $day, $hour, $minute, $second)
    {
        $julianDay = $this::GregorianEpoch - 1;
        $julianDay += (365 * ($year - 1));
        $julianDay += floor(($year - 1) / 4);
        $julianDay += floor(($year - 1) / 100) * -1;
        $julianDay += floor(($year - 1) / 400);
        $julianDay += floor((((367 * $month) - 362) / 12) + (($month <= 2) ? 0 : ($this->isLeap($year) ? -1 : -2)) + $day);
        return $this->addTimeToJulianDay($julianDay, $hour, $minute, $second);
    }

    public function isLeap($year)
    {
        return (($year % 4) == 0) && (!((($year % 100) == 0) && (($year % 400) != 0)));
    }

    public function daysInMonth($year, $month)
    {
        $gregorianDaysInMonth = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

        if ($month < 1 || $month > 12) {
            throw new \RangeException("$month Out Of Range Exception");
        }

        if ($year && $this->isLeap($year) && $month == 2) {
            return 29;
        }

        return $gregorianDaysInMonth[$month - 1];
    }
    
}