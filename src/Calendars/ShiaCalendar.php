<?php

namespace Pasoonate\Calendars;

use OutOfRangeException;
use Pasoonate\Constants;
use Pasoonate\DateTime;

class ShiaCalendar extends Calendar
{
    public function __construct()
    {
        parent::__construct('shia');
    }

    public function julianDayToDate($julianDay)
    {
        $time = $this->extractJulianDayTime($julianDay);

        $julianDay = $this->julianDayWithoutTime($julianDay);

        $year = floor(((($julianDay - Constants::SHIA_EPOCH) * 30) + 10646) / 10631);
        $month = min(12, ceil(($julianDay - (29 + $this->julianDayWithoutTime($this->dateToJulianDay($year, 1, 1, $time->hour, $time->minute, $time->second)))) / 29.5) + 1);
        $dayOfYear = $julianDay - $this->julianDayWithoutTime($this->dateToJulianDay($year -1, 12, $this->daysInMonth($year - 1, 12), $time->hour, $time->minute, $time->second));
        $days = 0;

        for ($i = 1; $i <= 12; $i++) {
            $days += $this->daysInMonth($year, $i);

            if ($dayOfYear <= $days) {
                $month = $i;
                break;
            }
        }

        //$day = ($julianDay - (($days - $this->daysInMonth($year, $month)) + (($year - 1) * 354) + floor((3 + (11 * $year)) / 30) + Constants::SHIA_EPOCH) + 1);
        $day = $dayOfYear - ($days - $this->daysInMonth($year, $month));

        $datetime = new DateTime($year, $month, $day, $time->hour, $time->minute, $time->second);

        return $datetime;;
    }

    public function dateToJulianDay($year, $month, $day, $hour, $minute, $second)
    {
        $daysInMonth = $this->daysInMonth($year, $month);
        $dayOfYear = $day;
        $julianDay = 0;

        if ($day > $daysInMonth) {
            $dayOfYear = $day - $daysInMonth;
            $year = $month === 12 ? $year + 1 : $year;
            $month = $month === 12 ? 1 : $month + 1;
        }

        for ($m = 1; $m < $month; $m++) {
            $dayOfYear += $this->daysInMonth($year, $m);
        }

        $julianDay += $dayOfYear;
        $julianDay += ($year - 1) * Constants::DAYS_OF_SHIA_YEAR;
        $julianDay += floor(((11 * $year) + 3) / 30);
        $julianDay += Constants::SHIA_EPOCH - ($year === 1440 ? 2 : 1);
        
        return $this->addTimeToJulianDay($julianDay, $hour, $minute, $second);
    }

    public function daysInMonth($year, $month)
    {
        $islamicDaysInMonth = [30, 29, 30, 29, 30, 29, 30, 29, 30, 29, 30, 29]; //30
        $shiaDaysInMonthInYears = [
            1435 => [29, 30, 29, 30, 29, 30, 29, 30, 30, 30, 29, 30],
            1436 => [29, 30, 29, 29, 30, 29, 30, 29, 30, 29, 30, 30],
            1437 => [29, 30, 30, 29, 30, 29, 29, 30, 29, 29, 30, 30],
            1438 => [29, 30, 30, 30, 29, 30, 29, 29, 30, 29, 29, 30],
            1439 => [29, 30, 30, 30, 30, 29, 30, 29, 29, 30, 29, 29],
            1440 => [30, 29, 30, 30, 30, 29, 29, 30, 29, 30, 29, 29],
            1441 => [29, 30, 29, 30, 30, 29, 30, 30, 29, 30, 29, 30],
            1442 => [29, 29, 30, 29, 30, 29, 30, 30, 30, 29, 30, 29],
        ];        
    
        if ($month < 1 || $month > 12) {
            throw new OutOfRangeException("$month Out Of Range Exception");
        }

        if (!isset($shiaDaysInMonthInYears[$year])) {
            return $islamicDaysInMonth[$month - 1];
        }

        return $shiaDaysInMonthInYears[$year][$month - 1];
    }

    public function isLeap($year)
    {
        $isLeap = ((($year * 11) + 14) % 30) < 11;
        
        return $isLeap;
    }
}