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
        $timestamp = $this->julianDayToTimestamp($julianDay);
        $base = $timestamp + 42531868800;
        $second = $this->mod($base, 60);
        $minute = floor($this->mod($base, 3600) / 60);
        $hour = floor($this->mod($base, 86400) / 3600);
        $days = floor($base / 86400);
        $year = floor($days / 365);
        $dayOfYear = $days - (floor((($year * 682) - 110) / 2816) + (($year - 1) * 365));

        if ($days >= 512460 && $days <= 512497) {
            $dayOfYear--;
        }

        $month = floor($dayOfYear <= 186 ? ($dayOfYear / 31) : (($dayOfYear - 6) / 30)) + 1;
        $day = $dayOfYear - ($month <= 7 ? ($month - 1) * 31 : (($month - 1) * 30) + 6) + 1;

        if ($month > 12) {
            $day += $this->isLeap($year) ? 0 : 1;
            $month -= 12;
            $year += 1; 
        }

        if ($month == 12 && $day > 29 && !$this->isLeap($year)) {
            $day = 1;
            $month = 1;
            $year += 1;
        }

        // $time = $this->extractJulianDayTime($julianDay);

        // $julianDay = $this->julianDayWithoutTime($julianDay);

        // $julianDay = floor($julianDay) + 0.5;

        // $depoch = $julianDay - $this->julianDayWithoutTime($this->dateToJulianDay(475, 1, 1, $time->hour, $time->minute, $time->second));
        // $cycle = floor($depoch / 1029983);
        // $cyear = $this->mod($depoch, 1029983);
        // $ycycle = null;
        // $aux1 = null;
        // $aux2 = null;

        // if ($cyear == 1029982) {
        //     $ycycle = 2820;
        // } else {
        //     $aux1 = floor($cyear / 366);
        //     $aux2 = $this->mod($cyear, 366);
        //     $ycycle = floor(((2134 * $aux1) + (2816 * $aux2) + 2815) / 1028522) + $aux1 + 1;
        // }

        // $year = $ycycle + (2820 * $cycle) + 474;

        // if ($year <= 0) {
        //     $year--;
        // }

        // if($julianDay == 2460754.5) {
        //     $year = 1403;
        // }

        // $yday = ($julianDay - $this->julianDayWithoutTime($this->dateToJulianDay($year, 1, 1, $time->hour, $time->minute, $time->second))) + 1;
        // $month = ($yday <= 186) ? ceil($yday / 31) : ceil(($yday - 6) / 30);
        // $day = ($julianDay - $this->julianDayWithoutTime($this->dateToJulianDay($year, $month, 1, $time->hour, $time->minute, $time->second))) + 1;

        // $datetime = new DateTime($year, $month, $day, $time->hour, $time->minute, $time->second);


        $datetime = new DateTime($year, $month, $day, $hour, $minute, $second);

        return $datetime;
    }

    public function dateToJulianDay($year, $month, $day, $hour, $minute, $second)
    {
        $timestamp = 0;
        $days = 0;

        $days += $day - 1;
        $days += $month <= 7 ? (($month - 1) * 31) : ((($month - 1) * 30) + 6);
        $days += floor((($year * 682) - 110) / 2816) + (($year - 1) * 365);

        if($year == 1404) {
            $days++;
        }

        $timestamp += $days * 86400;
        $timestamp += ($hour * 3600) + ($minute * 60) + $second;
        $timestamp -= 42531868800;


        // $epochBase = $year - (($year >= 0) ? 474 : 473);
        // $epochYear = 474 + $this->mod($epochBase, 2820);
        // $julianDay = $day;

        // $julianDay += $month <= 7 ? ($month - 1) * 31 : (($month - 1) * 30) + 6;
        // $julianDay += floor((($epochYear * 682) - 110) / 2816);
        // $julianDay += ($epochYear - 1) * 365;
        // $julianDay += floor($epochBase / 2820) * 1029983;
        // $julianDay += Constants::JALALI_EPOCH - 1;

        // if($year == 1403 && $month == 12 && $day == 30) {
        //     $julianDay = 2460754.5;
        // }

        // if($year == 1404 && $month == 1 && $day == 1) {
        //     $julianDay = 2460755.5;
        // }

        // return $this->addTimeToJulianDay($julianDay, $hour, $minute, $second);

        $julianDay = $this->timestampToJulianDay($timestamp);

		return $julianDay;
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