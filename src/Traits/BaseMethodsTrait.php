<?php

namespace Pasoonate\Traits;

trait BaseMethodsTrait
{
    public function setTimestamp($timestamp)
    {
        $this->_timestamp = $timestamp;
        return $this;
    }

    public function getTimestamp()
    {
        return $this->_timestamp;
    }

    public function setTimezoneOffset($timezoneOffset)
    {
        $this->_timezoneOffset = $timezoneOffset;
        return $this;
    }

    public function getTimezoneOffset()
    {
        return $this->_timezoneOffset;
    }

    public function setYear($year)
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp + $this->_timezoneOffset);
        $timestamp = $this->_currentCalendar->dateToTimestamp($year, $date->month, $date->day, $date->hour, $date->minute, $date->second);
        $this->_timestamp = $timestamp - $this->_timezoneOffset;
        return $this;
    }

    public function getYear()
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp + $this->_timezoneOffset);
        return $date->year;
    }

    public function setMonth($month)
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp + $this->_timezoneOffset);
        $timestamp = $this->_currentCalendar->dateToTimestamp($date->year, $month, $date->day, $date->hour, $date->minute, $date->second);
        $this->_timestamp = $timestamp - $this->_timezoneOffset;
        return $this;
    }

    public function getMonth()
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp + $this->_timezoneOffset);
        return $date->month;
    }

    public function setDay($day)
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp + $this->_timezoneOffset);
        $timestamp = $this->_currentCalendar->dateToTimestamp($date->year, $date->month, $day, $date->hour, $date->minute, $date->second);
        $this->_timestamp = $timestamp - $this->_timezoneOffset;
        return $this;
    }

    public function getDay()
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp + $this->_timezoneOffset);
        return $date->day;
    }

    public function setHour($hour)
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp + $this->_timezoneOffset);
        $timestamp = $this->_currentCalendar->dateToTimestamp($date->year, $date->month, $date->day, $hour, $date->minute, $date->second);
        $this->_timestamp = $timestamp - $this->_timezoneOffset;
        return $this;
    }

    public function getHour()
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp + $this->_timezoneOffset);
        return $date->hour;
    }

    public function setMinute($minute)
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp + $this->_timezoneOffset);
        $timestamp = $this->_currentCalendar->dateToTimestamp($date->year, $date->month, $date->day, $date->hour, $minute, $date->second);
        $this->_timestamp = $timestamp - $this->_timezoneOffset;
        return $this;
    }

    public function getMinute()
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp + $this->_timezoneOffset);
        return $date->minute;
    }

    public function setSecond($second)
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp + $this->_timezoneOffset);
        $timestamp = $this->_currentCalendar->dateToTimestamp($date->year, $date->month, $date->day, $date->hour, $date->minute, $second);
        $this->_timestamp = $timestamp - $this->_timezoneOffset;
        return $this;
    }

    public function getSecond()
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp + $this->_timezoneOffset);
        return $date->second;
    }

    public function setUTCYear($year)
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp);
        $this->_timestamp = $this->_currentCalendar->dateToTimestamp($year, $date->month, $date->day, $date->hour, $date->minute, $date->second);
        return $this;
    }

    public function getUTCYear()
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp);
        return $date->year;
    }

    public function setUTCMonth($month)
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp);
        $this->_timestamp = $this->_currentCalendar->dateToTimestamp($date->year, $month, $date->day, $date->hour, $date->minute, $date->second);
        return $this;
    }

    public function getUTCMonth()
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp);
        return $date->month;
    }

    public function setUTCDay($day)
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp);
        $this->_timestamp = $this->_currentCalendar->dateToTimestamp($date->year, $date->month, $day, $date->hour, $date->minute, $date->second);
        return $this;
    }

    public function getUTCDay()
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp);
        return $date->day;
    }

    public function setUTCHour($hour)
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp);
        $this->_timestamp = $this->_currentCalendar->dateToTimestamp($date->year, $date->month, $date->day, $hour, $date->minute, $date->second);
        return $this;
    }

    public function getUTCHour()
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp);
        return $date->hour;
    }

    public function setUTCMinute($minute)
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp);
        $this->_timestamp = $this->_currentCalendar->dateToTimestamp($date->year, $date->month, $date->day, $date->hour, $minute, $date->second);
        return $this;
    }

    public function getUTCMinute()
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp);
        return $date->minute;
    }

    public function setUTCSecond($second)
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp);
        $this->_timestamp = $this->_currentCalendar->dateToTimestamp($date->year, $date->month, $date->day, $date->hour, $date->minute, $second);
        return $this;
    }

    public function getUTCSecond()
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp);
        return $date->second;
    }

    public function setDate($year, $month, $day)
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp + $this->_timezoneOffset);
        $timestamp = $this->_currentCalendar->dateToTimestamp($year, $month, $day, $date->hour, $date->minute, $date->second);
        $this->_timestamp = $timestamp - $this->_timezoneOffset;
        return $this;
    }

    public function setTime($hour, $minute, $second)
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp + $this->_timezoneOffset);
        $timestamp = $this->_currentCalendar->dateToTimestamp($date->year, $date->month, $date->day, $hour, $minute, $second);
        $this->_timestamp = $timestamp - $this->_timezoneOffset;
        return $this;
    }

    public function setDateTime($year, $month, $day, $hour, $minute, $second)
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp + $this->_timezoneOffset);
        $timestamp = $this->_currentCalendar->dateToTimestamp($year, $month, $day, $hour, $minute, $second);
        $this->_timestamp = $timestamp - $this->_timezoneOffset;
        return $this;
    }

    public function setUTCDate($year, $month, $day)
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp);
        $this->_timestamp = $this->_currentCalendar->dateToTimestamp($year, $month, $day, $date->hour, $date->minute, $date->second);
        return $this;
    }

    public function setUTCTime($hour, $minute, $second)
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp);
        $this->_timestamp = $this->_currentCalendar->dateToTimestamp($date->year, $date->month, $date->day, $hour, $minute, $second);
        return $this;
    }

    public function setUTCDateTime($year, $month, $day, $hour, $minute, $second)
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp);
        $this->_timestamp = $this->_currentCalendar->dateToTimestamp($year, $month, $day, $hour, $minute, $second);
        return $this;
    }

    public function dayOfWeek()
    {
        return $this->_currentCalendar->dayOfWeek($this->_timestamp + $this->_timezoneOffset);
    }

    public function dayOfYear()
    {
        return $this->_currentCalendar->dayOfYear($this->_timestamp + $this->_timezoneOffset);
    }

    public function weekOfMonth()
    {
        return $this->_currentCalendar->weekOfMonth($this->_timestamp + $this->_timezoneOffset);
    }

    public function weekOfYear()
    {
        return $this->_currentCalendar->weekOfYear($this->_timestamp + $this->_timezoneOffset);
    }
}