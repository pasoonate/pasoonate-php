<?php

namespace Pasoonate\Traits;

use Pasoonate\Date;
use Pasoonate\Time;

trait Base
{
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function setTimezoneOffset($timezoneOffset)
    {
        $this->timezoneOffset = $timezoneOffset;

        return $this;
    }

    public function getTimezoneOffset()
    {
        return $this->timezoneOffset;
    }

    public function setYear($year)
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);
        $timestamp = $this->currentCalendar->dateToTimestamp($year, $date->month, $date->day, $date->hour, $date->minute, $date->second);
        $this->timestamp = $timestamp - $this->timezoneOffset;

        return $this;
    }

    public function getYear()
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);

        return $date->year;
    }

    public function setJulianDayNumber($julianDay)
    {
        $datetime = $this->currentCalendar->julianDayToDate($julianDay);
        $this->setYear($datetime->year);
        $this->setMonth($datetime->month);
        $this->setDay($datetime->day);
        $this->setHour($datetime->hour);
        $this->setMinute($datetime->minute);
        $this->setSecond($datetime->second);
        return $this;
    }

    public function getJulianDayNumber()
    {
        return $this->currentCalendar->dateToJulianDay($this->getYear(), $this->getMonth(), $this->getDay(), $this->getHour(), $this->getMinute(), $this->getSecond());
    }

    public function setMonth($month)
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);
        $timestamp = $this->currentCalendar->dateToTimestamp($date->year, $month, $date->day, $date->hour, $date->minute, $date->second);
        $this->timestamp = $timestamp - $this->timezoneOffset;

        return $this;
    }

    public function getMonth()
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);

        return $date->month;
    }

    public function setDay($day)
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);
        $timestamp = $this->currentCalendar->dateToTimestamp($date->year, $date->month, $day, $date->hour, $date->minute, $date->second);
        $this->timestamp = $timestamp - $this->timezoneOffset;

        return $this;
    }

    public function getDay()
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);

        return $date->day;
    }

    public function setHour($hour)
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);
        $timestamp = $this->currentCalendar->dateToTimestamp($date->year, $date->month, $date->day, $hour, $date->minute, $date->second);
        $this->timestamp = $timestamp - $this->timezoneOffset;

        return $this;
    }

    public function getHour()
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);

        return $date->hour;
    }

    public function setMinute($minute)
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);
        $timestamp = $this->currentCalendar->dateToTimestamp($date->year, $date->month, $date->day, $date->hour, $minute, $date->second);
        $this->timestamp = $timestamp - $this->timezoneOffset;

        return $this;
    }

    public function getMinute()
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);

        return $date->minute;
    }

    public function setSecond($second)
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);
        $timestamp = $this->currentCalendar->dateToTimestamp($date->year, $date->month, $date->day, $date->hour, $date->minute, $second);
        $this->timestamp = $timestamp - $this->timezoneOffset;

        return $this;
    }

    public function getSecond()
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);

        return $date->second;
    }

    public function setUTCYear($year)
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp);
        $this->timestamp = $this->currentCalendar->dateToTimestamp($year, $date->month, $date->day, $date->hour, $date->minute, $date->second);

        return $this;
    }

    public function getUTCYear()
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp);

        return $date->year;
    }

    public function setUTCMonth($month)
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp);
        $this->timestamp = $this->currentCalendar->dateToTimestamp($date->year, $month, $date->day, $date->hour, $date->minute, $date->second);

        return $this;
    }

    public function getUTCMonth()
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp);

        return $date->month;
    }

    public function setUTCDay($day)
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp);
        $this->timestamp = $this->currentCalendar->dateToTimestamp($date->year, $date->month, $day, $date->hour, $date->minute, $date->second);

        return $this;
    }

    public function getUTCDay()
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp);

        return $date->day;
    }

    public function setUTCHour($hour)
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp);
        $this->timestamp = $this->currentCalendar->dateToTimestamp($date->year, $date->month, $date->day, $hour, $date->minute, $date->second);

        return $this;
    }

    public function getUTCHour()
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp);

        return $date->hour;
    }

    public function setUTCMinute($minute)
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp);
        $this->timestamp = $this->currentCalendar->dateToTimestamp($date->year, $date->month, $date->day, $date->hour, $minute, $date->second);

        return $this;
    }

    public function getUTCMinute()
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp);

        return $date->minute;
    }

    public function setUTCSecond($second)
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp);
        $this->timestamp = $this->currentCalendar->dateToTimestamp($date->year, $date->month, $date->day, $date->hour, $date->minute, $second);

        return $this;
    }

    public function getUTCSecond()
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp);

        return $date->second;
    }

    public function setDate($year, $month, $day)
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);
        $timestamp = $this->currentCalendar->dateToTimestamp($year, $month, $day, $date->hour, $date->minute, $date->second);
        $this->timestamp = $timestamp - $this->timezoneOffset;

        return $this;
    }

    public function getDate()
    {
        $datetime = $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);
        return new Date($datetime->year, $datetime->month, $datetime->day);
    }

    public function setTime($hour, $minute, $second)
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);
        $timestamp = $this->currentCalendar->dateToTimestamp($date->year, $date->month, $date->day, $hour, $minute, $second);
        $this->timestamp = $timestamp - $this->timezoneOffset;

        return $this;
    }

    public function getTime()
    {
        $datetime = $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);
        return new Time($datetime->hour, $datetime->minute, $datetime->second);
    }

    public function setDateTime($year, $month, $day, $hour, $minute, $second)
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);
        $timestamp = $this->currentCalendar->dateToTimestamp($year, $month, $day, $hour, $minute, $second);
        $this->timestamp = $timestamp - $this->timezoneOffset;

        return $this;
    }

    public function getDateTime()
    {
        return $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);
    }

    public function setUTCDate($year, $month, $day)
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp);
        $this->timestamp = $this->currentCalendar->dateToTimestamp($year, $month, $day, $date->hour, $date->minute, $date->second);

        return $this;
    }

    public function setUTCTime($hour, $minute, $second)
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp);
        $this->timestamp = $this->currentCalendar->dateToTimestamp($date->year, $date->month, $date->day, $hour, $minute, $second);

        return $this;
    }

    public function setUTCDateTime($year, $month, $day, $hour, $minute, $second)
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp);
        $this->timestamp = $this->currentCalendar->dateToTimestamp($year, $month, $day, $hour, $minute, $second);

        return $this;
    }

    public function dayOfWeek()
    {
        return $this->currentCalendar->dayOfWeek($this->timestamp + $this->timezoneOffset);
    }

    public function dayOfYear()
    {
        return $this->currentCalendar->dayOfYear($this->timestamp + $this->timezoneOffset);
    }

    public function weekOfMonth()
    {
        return $this->currentCalendar->weekOfMonth($this->timestamp + $this->timezoneOffset);
    }

    public function weekOfYear()
    {
        return $this->currentCalendar->weekOfYear($this->timestamp + $this->timezoneOffset);
    }

    public function daysInMonth()
    {
        return $this->currentCalendar->daysInMonth($this->getYear(), $this->getMonth());
    }
}