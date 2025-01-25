<?php

declare(strict_types=1);

namespace Pasoonate\Calendars;

use OutOfRangeException;
use Pasoonate\Constants;
use Pasoonate\DateTime;

class JalaliCalendar extends Calendar
{
    public function __construct()
    {
        parent::__construct(Constants::JALALI);
    }

    public function julianDayToDate(float $julianDay): DateTime
    {
        $timestamp = $this->julianDayToTimestamp($julianDay);
        $base = $timestamp + 42531868800;
        $second = (int)$this->mod($base, Constants::SECONDS_PER_MINUTE);
        $minute = (int)floor($this->mod($base, Constants::HOUR_IN_SECONDS) / Constants::MINUTES_PER_HOUR);
        $hour = (int)floor($this->mod($base, Constants::DAY_IN_SECONDS) / Constants::HOUR_IN_SECONDS);
        $days = (int)floor($base / Constants::DAY_IN_SECONDS);
        $fyear = (int)floor($days / Constants::DAYS_OF_TROPICAL_JALALI_YEAR);
        $year = (int)floor($days / Constants::DAYS_OF_JALALI_YEAR);
        $dayOfYear = $days - floor($fyear * Constants::DAYS_OF_TROPICAL_JALALI_YEAR);

        if ($this->isLeap($fyear)) {
            $dayOfYear--;
        }

        if ($dayOfYear >= Constants::DAYS_OF_JALALI_YEAR && !$this->isLeap($year)) {
            $dayOfYear = 0;
            $year++;
        }

        if ($year === $fyear) {
            $year++;
        }

        $month = (int)floor($dayOfYear <= 186 ? ($dayOfYear / 31) : (($dayOfYear - 6) / 30)) + 1;
        $day = (int)($dayOfYear - ($month <= 7 ? ($month - 1) * 31 : (($month - 1) * 30) + 6) + 1);

        $datetime = new DateTime($year, $month, $day, $hour, $minute, $second);

        return $datetime;
    }

    public function dateToJulianDay(int $year, int $month, int $day, int $hour, int $minute, int $second): float
    {
        $timestamp = 0;
        $days = 0;

        $days += floor(($year - 1) * Constants::DAYS_OF_TROPICAL_JALALI_YEAR);
        $days += $month <= 7 ? (($month - 1) * 31) : ((($month - 1) * 30) + 6);
        $days += $day - 1;

        if ($this->isLeap($year - 1)) {
            $days++;
        }

        $timestamp += $days * Constants::DAY_IN_SECONDS;
        $timestamp += ($hour * Constants::HOUR_IN_SECONDS) + ($minute * Constants::SECONDS_PER_MINUTE) + $second;
        $timestamp -= 42531868800;

        $julianDay = $this->timestampToJulianDay((int)$timestamp);

        return $julianDay;
    }

    public function daysInMonth(int $year, int $month): int
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

    public function isLeap(int $year): bool
    {
        $validRemainValueAfter1343 = [1, 5, 9, 13, 17, 22, 26, 30];
        $validRemainValueBefore1343 = [1, 5, 9, 13, 17, 21, 26, 30];

        $remain = $year % 33;

        return $year < 1343 ? in_array($remain, $validRemainValueBefore1343) : in_array($remain, $validRemainValueAfter1343);
    }
}