<?php

declare(strict_types=1);

namespace Pasoonate\Calendars;

use Pasoonate\Constants;
use Pasoonate\Date;
use Pasoonate\DateTime;
use Pasoonate\Time;
use stdClass;

abstract class Calendar
{
    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    final public function getName(): string
    {
        return $this->name;
    }

    final public function timestampToJulianDay(int $timestamp): float
    {
        $julianDay = ($timestamp / Constants::DAY_IN_SECONDS) + Constants::J1970;

        $julianDayFloatRounded = round(($julianDay - floor($julianDay)) * 10000000) / 10000000;

        return floor($julianDay) + $julianDayFloatRounded;
    }

    final public function julianDayToTimestamp(float $julianDay): int
    {
        $timestamp = (int)round(($julianDay - Constants::J1970) * Constants::DAY_IN_SECONDS);

        return $timestamp;
    }

    final public function julianDayWithoutTime(float $julianDay): float
    {
        return floor($julianDay) + (($julianDay - floor($julianDay)) >= 0.5 ? 0.5 : -0.5);
    }

    final public function extractJulianDayTime(float $julianDay): Time
    {
        $julianDay += 0.5;

        // Astronomical to civil
        $time = round(($julianDay - floor($julianDay)) * Constants::DAY_IN_SECONDS);

        return new Time((int)floor($time / Constants::HOUR_IN_SECONDS), floor($time / Constants::MINUTES_PER_HOUR) % Constants::SECONDS_PER_MINUTE, (int)floor($time % Constants::SECONDS_PER_MINUTE));
    }

    final public function addTimeToJulianDay(float $julianDay, int $hour, int $minute, int $second): float
    {
        $timestamp = $this->julianDayToTimestamp($julianDay);
        $timestamp += ($hour * Constants::HOUR_IN_SECONDS) + ($minute * Constants::MINUTES_PER_HOUR) + $second;

        $julianDay = $this->timestampToJulianDay($timestamp);
        $julianDayFloatRounded = round(($julianDay - floor($julianDay)) * 10000000) / 10000000;

        return floor($julianDay) + $julianDayFloatRounded;
    }

    abstract public function dateToJulianDay(int $year, int $month, int $day, int $hour, int $minute, int $second): float;

    final public function dateToTimestamp(int $year, int $month, int $day, int $hour, int $minute, int $second): int
    {
        $julianDay = $this->dateToJulianDay($year, $month, $day, $hour, $minute, $second);

        return $this->julianDayToTimestamp($julianDay);
    }

    abstract public function julianDayToDate(float $julianDay): DateTime;

    final public function timestampToDate(int $timestamp): DateTime
    {
        $julianDay = $this->timestampToJulianDay($timestamp);

        return $this->julianDayToDate($julianDay);
    }

    abstract public function daysInMonth(int $year, int $month): int;

    final public function dayOfWeek(int $timestamp): int
    {
        $julianDay = $this->timestampToJulianDay($timestamp);

        return intval($this->mod(floor($julianDay + 2.5), Constants::DAYS_PER_WEEK));
    }

    final public function dayOfYear(int $timestamp): int
    {
        $currentDate = $this->timestampToDate($timestamp);
        $firstOfYearJulianDay = $this->dateToJulianDay($currentDate->year, 1, 1, 0, 0, 0);
        $currentJulianDay = $this->dateToJulianDay($currentDate->year, $currentDate->month, $currentDate->day, $currentDate->hour, $currentDate->minute, $currentDate->second);

        return intval(floor($currentJulianDay - $firstOfYearJulianDay + 1));
    }

    final public function weekOfMonth(int $timestamp): int
    {
        $currentDate = $this->timestampToDate($timestamp);
        $firstDayOfMonthTimestamp = $this->dateToTimestamp($currentDate->year, $currentDate->month, 1, $currentDate->hour, $currentDate->minute, $currentDate->second);
        $dayOfWeekInCurrentDayOfMonth = $this->dayOfWeek($timestamp);
        $dayOfWeekInFirstDayOfMonth = $this->dayOfWeek($firstDayOfMonthTimestamp);
        $week = 1;

        if ($currentDate->day <= (Constants::DAYS_PER_WEEK - $dayOfWeekInFirstDayOfMonth)) {
            return $week;
        }

        $week += (($currentDate->day - ((Constants::DAYS_PER_WEEK - $dayOfWeekInFirstDayOfMonth) + ($dayOfWeekInCurrentDayOfMonth + 1))) / 7) + 1;

        return $week;
    }

    final public function weekOfYear(int $timestamp): int
    {
        $currentDate = $this->timestampToDate($timestamp);
        $dayOfYear = $this->dayOfYear($timestamp);
        $firstDayOfYearTimestamp = $this->dateToTimestamp($currentDate->year, 1, 1, $currentDate->hour, $currentDate->minute, $currentDate->second);
        $dayOfWeekInCurrentDayOfYear = $this->dayOfWeek($timestamp);
        $dayOfWeekInFirstDayOfYear = $this->dayOfWeek($firstDayOfYearTimestamp);
        $week = 1;

        if ($dayOfYear <= (Constants::DAYS_PER_WEEK - $dayOfWeekInFirstDayOfYear)) {
            return $week;
        }

        $week += (($dayOfYear - ((Constants::DAYS_PER_WEEK - $dayOfWeekInFirstDayOfYear) + ($dayOfWeekInCurrentDayOfYear + 1))) / Constants::DAYS_PER_WEEK) + 1;

        return $week;
    }

    final public function mod(int|float $a, int|float $b): int|float
    {
        return $a - ($b * floor($a / $b));
    }

    abstract public function isLeap(int $year): bool;
}