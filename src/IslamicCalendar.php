<?php

namespace Pasoonate;

class IslamicCalendar extends Calendar
{
    const IslamicEpoch = 1948439.5;

    public function __construct()
    {

    }

    public function julianDayToDate($julianDay)
    {
        $time = $this->extractJulianDayTime($julianDay);
        $julianDay = $this->julianDayWithoutTime($julianDay);
        $julianDay = floor($julianDay) + 0.5;
        $year = floor(((($julianDay - $this::IslamicEpoch) * 30) + 10646) / 10631);
        $month = min(12, ceil(($julianDay - (29 + $this->julianDayWithoutTime($this->dateToJulianDay($year, 1, 1, $time->hour, $time->minute, $time->second)))) / 29.5) + 1);
        $day = $julianDay - $this->julianDayWithoutTime($this->dateToJulianDay($year, $month, 1, $time->hour, $time->minute, $time->second)) + 1;

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
        $julianDay = $day;
        $julianDay += ceil(($month - 1) * 29.5);
        $julianDay += ($year - 1) * 354;
        $julianDay += floor(((11 * $year) + 3) / 30);
        $julianDay += $this::IslamicEpoch - 1;
        return $this->addTimeToJulianDay($julianDay, $hour, $minute, $second);
    }

    public function daysInMonth($year, $month)
    {
        $islamicDaysInMonth = array(30, 29, 30, 29, 30, 29, 30, 29, 30, 29, 30, 29);
        if ($month < 1 || $month > 12) {
            throw new RangeException("$month Out Of Range Exception");
        }
        if ($year && $this->isLeap($year) && $month == 12) {
            return 30;
        }
        return $islamicDaysInMonth[$month - 1];
    }

    public function isLeap($year)
    {
        $isLeap = ((($year * 11) + 14) % 30) < 11;
        return $isLeap;
    }
}