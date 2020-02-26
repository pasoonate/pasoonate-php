<?php

namespace Pasoonate\Calendar;

use Pasoonate\Constants;
use Pasoonate\Date;
use Pasoonate\Time;
use stdClass;

abstract class Calendar
{
    protected $name;

    /**
     * @param string $name
     * 
     * @return void
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    final public function getName()
    {
        return $this->name;
    }

    /**
     * @param int $timestamp
     * 
     * @return float
     */
    final public function timestampToJulianDay($timestamp)
    {
        $julianDay = ($timestamp / Constants::DAY_IN_SECOND) + Constants::J1970;

        $julianDayFloatRounded = round(($julianDay - floor($julianDay)) * 10000000) / 10000000;

        return floor($julianDay) + $julianDayFloatRounded;
    }

    /**
     * @param float $julianDay
     * 
     * @return int
     */
    final public function julianDayToTimestamp($julianDay)
    {
        $timestamp = round(($julianDay - Constants::J1970) * Constants::DAY_IN_SECOND);
        
        return $timestamp;
    }

    /**
     * @param float $julianDay
     * 
     * @return float
     */
    final public function julianDayWithoutTime($julianDay)
    {
        return floor($julianDay) + (($julianDay - floor($julianDay)) >= 0.5 ? 0.5 : -0.5);
    }

    /**
     * @param float $julianDay
     * 
     * @return Time
     */
    final public function extractJulianDayTime($julianDay)
    {
        $julianDay += 0.5;

        // Astronomical to civil
        $time = floor(($julianDay - floor($julianDay)) * Constants::DAY_IN_SECOND);

        return new Time(floor($time / 3600), floor(($time / 60) % 60), floor($time % 60));
    }

    /**
     * @param float $julianDay
     * @param int $hour
     * @param int $minute
     * @param int $second
     * 
     * @return float
     */
    final public function addTimeToJulianDay($julianDay, $hour, $minute, $second)
    {
        $timestamp = $this->julianDayToTimestamp($julianDay);
        $timestamp += ($hour * 3600) + ($minute * 60) + $second;

        $julianDay = $this->timestampToJulianDay($timestamp);
        $julianDayFloatRounded = round(($julianDay - floor($julianDay)) * 10000000) / 10000000;

        return floor($julianDay) + $julianDayFloatRounded;
    }

    /**
     * @param int $year
     * @param int $month
     * @param int $day
     * @param int $hour
     * @param int $minute
     * @param int $second
     * 
     * @return float
     */
    abstract public function dateToJulianDay($year, $month, $day, $hour, $minute, $second);
    
    /**
     * @param int $year
     * @param int $month
     * @param int $day
     * @param int $hour
     * @param int $minute
     * @param int $second
     * 
     * @return int
     */
    final public function dateToTimestamp($year, $month, $day, $hour, $minute, $second)
    {
        $julianDay = $this->dateToJulianDay($year, $month, $day, $hour, $minute, $second);
        
        return $this->julianDayToTimestamp($julianDay);
    }
   
    /**
     * @param float $julianDay
     * 
     * @return Date
     */
    abstract public function julianDayToDate($julianDay);

    /**
     * @param int $timestamp
     * 
     * @return Date
     */
    final public function timestampToDate($timestamp)
    {
        $julianDay = $this->timestampToJulianDay($timestamp);

        return $this->julianDayToDate($julianDay);
    }

    /**
     * @param int $year
     * @param int $month
     * 
     * @param int
     */
    abstract public function daysInMonth($year, $month);

    /**
     * @param int $timestamp
     * 
     * @return int
     */
    final public function dayOfWeek($timestamp)
    {
        $julianDay = $this->timestampToJulianDay($timestamp);

        return $this->mod(floor($julianDay + 2.5), 7);
    }

    /**
     * @param int $timestamp
     * 
     * @return int
     */
    final public function dayOfYear($timestamp)
    {
        $currentDate = $this->timestampToDate($timestamp);
        $firstOfYearJulianDay = $this->dateToJulianDay($currentDate->year, 1, 1, 0, 0, 0);
        $currentJulianDay = $this->dateToJulianDay($currentDate->year, $currentDate->month, $currentDate->day, $currentDate->hour, $currentDate->minute, $currentDate->second);
        
        return floor($currentJulianDay - $firstOfYearJulianDay + 1);
    }

    /**
     * @param int $timestamp
     * 
     * @return int
     */
    final public function weekOfMonth($timestamp)
    {
        $currentDate = $this->timestampToDate($timestamp);
        $firstDayOfMonthTimestamp = $this->dateToTimestamp($currentDate->year, $currentDate->month, 1, $currentDate->hour, $currentDate->minute, $currentDate->second);
        $dayOfWeekInCurrentDayOfMonth = $this->dayOfWeek($timestamp);
        $dayOfWeekInFirstDayOfMonth = $this->dayOfWeek($firstDayOfMonthTimestamp);
        $week = 1;
        
        if ($currentDate->day <= (7 - $dayOfWeekInFirstDayOfMonth)) {
            return $week;
        }

        $week += (($currentDate->day - ((7 - $dayOfWeekInFirstDayOfMonth) + ($dayOfWeekInCurrentDayOfMonth + 1))) / 7) + 1;
        
        return $week;
    }

    /**
     * @param int $timestamp
     * 
     * @return int
     */
    final public function weekOfYear($timestamp)
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

    /**
     * @param int $a
     * @param int $b
     * 
     * @return int
     */
    final public function mod($a, $b)
    {
        return $a - ($b * floor($a / $b));
    }

    /**
     * @param int $year
     * 
     * @return bool
     */
    abstract public function isLeap($year);
}