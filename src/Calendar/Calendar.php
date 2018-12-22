<?php

namespace Pasoonate\Calendar;

class Calendar
{
    const J1970 = 2440587.5; // Julian date at Unix epoch: 1970-01-01
    const DayInSecond = 86400;

    public function __construct()
    {
    }

    public function timestampToJulianDay($timestamp)
    {
        $julianDay =  ($timestamp / $this->DayInSecond) + $this->J1970;
        
        $julianDayFloatRounded = round(($julianDay - floor($julianDay)) * 10000000) / 10000000;

        return floor($julianDay) + $julianDayFloatRounded;
    }

    public function julianDayToTimestamp($julianDay)
    {
        $timestamp = round(($julianDay - $this::J1970) * $this::DayInSecond);
        return $timestamp;
    }

    public function julianDayWithoutTime($julianDay)
    {
        return floor($julianDay) + (($julianDay - floor($julianDay)) >= 0.5 ?  0.5 : -0.5);        
    }

    public function extractJulianDayTime($julianDay)
    {
        $julianDay += 0.5;

        // Astronomical to civil
        $time = floor(($julianDay - floor($julianDay)) * $this::DayInSecond) + 0.5;        

        $dayTime = new \stdClass();
        $dayTime->hour = floor($time / 3600);
        $dayTime->minute = floor(($time / 60) % 60);
        $dayTime->second = floor($time % 60);
        return $dayTime;
    }

    public function addTimeToJulianDay($julianDay, $hour, $minute, $second)
    {
        $timestamp = $this->julianDayToTimestamp($julianDay);
        $timestamp += ($hour * 3600) + ($minute * 60) + $second;

        $julianDay = $this->$timestampToJulianDay($timestamp);
        $julianDayFloatRounded = round(($julianDay - floor($julianDay)) * 10000000) / 10000000;

        return floor($julianDay) + $julianDayFloatRounded;
    }

    public function dateToJulianDay($year, $month, $day, $hour, $minute, $second)
    {
        //
    }

    public function dateToTimestamp($year, $month, $day, $hour, $minute, $second)
    {
        $julianDay = $this->dateToJulianDay($year, $month, $day, $hour, $minute, $second);
        return $this->julianDayToTimestamp($julianDay);
    }

    public function julianDayToDate ($julianDay)
    {
        //
    }

    public function timestampToDate($timestamp)
    {
        $julianDay = $this->timestampToJulianDay($timestamp);
        return $this->julianDayToDate($julianDay);
    }


    public function daysInMonth($year, $month)
    {
        return 0;
    }

    public function dayOfWeek($timestamp)
    {
        $julianDay = $this->timestampToJulianDay($timestamp);
        return $this->mod(floor($julianDay + 2.5), 7);
    }

    public function dayOfYear($timestamp)
    {
        $currentDate = $this->timestampToDate($timestamp);
        $firstOfYearJulianDay = $this->dateToJulianDay($currentDate->year, 1, 1, 0, 0, 0);
        $currentJulianDay = $this->dateToJulianDay($currentDate->year, $currentDate->month, $currentDate->day, $currentDate->hour, $currentDate->minute, $currentDate->second);
        return floor($currentJulianDay - $firstOfYearJulianDay + 1);
    }

    public function weekOfMonth($timestamp)
    {
        $currentDate = $this->timestampToDate($timestamp);
        $firstDayOfMonthTimestamp = $this->dateToTimestamp($currentDate->year, $currentDate->month, 1, $currentDate->hour, $currentDate->minute, $currentDate->second);
        $dayOfWeekInCurrentDayOfMonth = $this->dayOfWeek($timestamp);
        $dayOfWeekInFirstDayOfMonth = $this->dayOfWeek($firstDayOfMonthTimestamp);
        $week = 1;
        if ($currentDate->day <= (7 - $dayOfWeekInFirstDayOfMonth) {
            return $week;
        }
        $week += (($currentDate->day - ((7 - $dayOfWeekInFirstDayOfMonth) + ($dayOfWeekInCurrentDayOfMonth + 1))) / 7) + 1;
        return $week;
    }

    public function weekOfYear($timestamp)
    {
        $currentDate = $this->timestampToDate($timestamp);
        $dayOfYear = $this->dayOfYear($timestamp);
        $firstDayOfYearTimestamp = $this->dateToTimestamp($currentDate->year, 1, 1, $currentDate->hour, $currentDate->minute, $currentDate->second);
        $dayOfWeekInCurrentDayOfYear = $this->dayOfWeek($timestamp);
        $dayOfWeekInFirstDayOfYear = $this->dayOfWeek($firstDayOfYearTimestamp);
        $week = 1;
        if ($dayOfYear <= (7 - $dayOfWeekInFirstDayOfYear)) {
            return $week;
        }
        $week += (($dayOfYear - ((7 - $dayOfWeekInFirstDayOfYear) + ($dayOfWeekInCurrentDayOfYear + 1))) / 7) + 1;
        return $week;
    }


    public function mod($a, $b)
    {

        return $a - ($b * floor($a / $b));
    }


    public function isLeap($year)
    {
        //
    }
}