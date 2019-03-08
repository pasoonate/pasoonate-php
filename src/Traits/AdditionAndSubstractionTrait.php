<?php

namespace Pasoonate\Traits;

trait AdditionAndSubstractionTrait
{
    public function addYear($count)
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp + $this->_timezoneOffset);
        $timestamp = $this->_currentCalendar->dateToTimestamp($date->year + $count, $date->month, $date->day, $date->hour, $date->minute, $date->second);
        $this->_timestamp = $timestamp - $this->_timezoneOffset;
        return $this;
    }

    public function addMount($count)
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp + $this->_timezoneOffset);
        $totalMonth = $date->month + $count;
        $year = $date->year + floor($totalMonth / 12);
        $month = $totalMonth % 12;
        $timestamp = $this->_currentCalendar->dateToTimestamp($year, $month, $date->day, $date->hour, $date->minute, $date->second);
        $this->_timestamp = $timestamp - $this->_timezoneOffset;
        return $this;
    }

    public function addDay($count)
    {
        $this->_timestamp = $this->_timestamp + ($count * 86400);
        return $this;
    }

    public function addHour($count)
    {
        $this->_timestamp = $this->_timestamp + ($count * 3600);
        return $this;
    }

    public function addMinute($count)
    {
        $this->_timestamp = $this->_timestamp + ($count * 60);
        return $this;
    }

    public function addSecond($count)
    {
        $this->_timestamp = $this->_timestamp + $count;
        return $this;
    }

    public function subYear($count)
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp + $this->_timezoneOffset);
        $timestamp = $this->_currentCalendar->dateToTimestamp($date->year - $count, $date->month, $date->day, $date->hour, $date->minute, $date->second);
        $this->_timestamp = $timestamp - $this->_timezoneOffset;
        return $this;
    }

    public function subMount($count)
    {
        $date = $this->_currentCalendar->timestampToDate($this->_timestamp + $this->_timezoneOffset);
        $totalMonth = $date->month - $count;
        $year = $date->year;
        $month = $totalMonth;

        if ($totalMonth <= 0) {
            $totalMonth = -$totalMonth;
            $year -= floor($totalMonth / 12) + 1;
            $month = 12 - ($totalMonth % 12);
        }

        $timestamp = $this->_currentCalendar->dateToTimestamp($year, $month, $date->day, $date->hour, $date->minute, $date->second);
        $this->_timestamp = $timestamp - $this->_timezoneOffset;
        return $this;
    }

    public function subDay($count)
    {
        $this->_timestamp = $this->_timestamp - ($count * 86400);
        return $this;
    }

    public function subHour($count)
    {
        $this->_timestamp = $this->_timestamp - ($count * 3600);
        return $this;
    }

    public function subMinute($count)
    {
        $this->_timestamp = $this->_timestamp - ($count * 60);
        return $this;
    }

    public function subSecond($count)
    {
        $this->_timestamp = $this->_timestamp - $count;
        return $this;
    }
}