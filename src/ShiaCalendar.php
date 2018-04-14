<?php

namespace MahdiBagheri\Pasoonate;

class ShiaCalendar extends Calendar
{
    const ShiaEpoch = 1948439.5;

    public function __construct()
    {

    }

    public function julianDayToDate($julianDay)
    {
        $time = $this->extractJulianDayTime($julianDay);
        $julianDay = $this->julianDayWithoutTime($julianDay);
        $julianDay = floor($julianDay) + 0.5;
        $year = floor(((($julianDay - $this::ShiaEpoch) * 30) + 10646) / 10631);
        $month = min(12, ceil(($julianDay - (29 + $this->julianDayWithoutTime($this->dateToJulianDay($year, 1, 1, $time->hour, $time->minute, $time->second)))) / 29.5) + 1);
        $dayOfYear = $julianDay - $this->julianDayWithoutTime($this->dateToJulianDay($year, 1, 1, $time->hour, $time->minute, $time->second));
        $days = 0;
        for ($i = 1;
             $i <= 12; $i++) {
            $days += $this->daysInMonth($year, $i);
            if ($dayOfYear < $days) {
                $month = $i;
                break;
            }
        }
        $day = ($julianDay - (($days - $this->daysInMonth($year, $month)) + (($year - 1) * 354) + floor((3 + (11 * $year)) / 30) + $this::ShiaEpoch) + 1);

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
        $dayOfYear = $day;
        $julianDay = 0;
        for ($i = 1;
             $i < $month; $i++) {
            $dayOfYear += $this->daysInMonth($year, $i);
        }
        $julianDay += $dayOfYear;
        $julianDay += ($year - 1) * 354;
        $julianDay += floor(((11 * $year) + 3) / 30);
        $julianDay += $this::ShiaEpoch - 1;
        return $this->addTimeToJulianDay($julianDay, $hour, $minute, $second);
    }

    public function daysInMonth($year, $month)
    {
        $islamicDaysInMonth = array(30, 29, 30, 29, 30, 29, 30, 29, 30, 29, 30, 29);
        $shiaDaysInMonthInYears = array("1435" => array(29, 30, 29, 30, 29, 30, 29, 30, 30, 30, 29, 30), "1436" => array(29, 30, 29, 29, 30, 29, 30, 29, 30, 29, 30, 30), "1437" => array(29, 30, 30, 29, 30, 29, 29, 30, 29, 29, 30, 30), "1438" => array(29, 30, 30, 30, 29, 30, 29, 29, 30, 29, 29, 30), "1439" => array(29, 30, 30, 30, 30, 29, 30, 29, 29, 30, 29, 29), "1440" => array(30, 29, 30, 30, 30, 29, 29, 30, 29, 30, 29, 29));
        if ($month < 1 || $month > 12) {
            throw new RangeException("$month Out Of Range Exception");
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