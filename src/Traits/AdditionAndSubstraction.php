<?php

namespace Pasoonate\Traits;

use Pasoonate\Constants;

trait AdditionAndSubstraction
{
    public function addYear($count)
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);
        $timestamp = $this->currentCalendar->dateToTimestamp($date->year + $count, $date->month, $date->day, $date->hour, $date->minute, $date->second);
        $this->timestamp = $timestamp - $this->timezoneOffset;

        return $this;
    }

    public function addMonth($count)
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);
        $totalMonth = $date->month + $count;
        $year = $date->year + floor($totalMonth / 12) - (($totalMonth % 12) == 0 ? 1 : 0);
        $month = ($totalMonth % 12) == 0 ? 12 : ($totalMonth % 12);

        $daysInMonth = $this->currentCalendar->daysInMonth($year, $month);
        $day = $date->day <= $daysInMonth ? $date->day : $daysInMonth;

        $timestamp = $this->currentCalendar->dateToTimestamp($year, $month, $day, $date->hour, $date->minute, $date->second);
        $this->timestamp = $timestamp - $this->timezoneOffset;

        return $this;
    }

    public function addDay($count)
    {
        $this->timestamp = $this->timestamp + ($count * Constants::DAY_IN_SECONDS);

        return $this;
    }

    public function addHour($count)
    {
        $this->timestamp = $this->timestamp + ($count * 3600);

        return $this;
    }

    public function addMinute($count)
    {
        $this->timestamp = $this->timestamp + ($count * 60);

        return $this;
    }

    public function addSecond($count)
    {
        $this->timestamp = $this->timestamp + $count;

        return $this;
    }

    public function subYear($count)
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);
        $timestamp = $this->currentCalendar->dateToTimestamp($date->year - $count, $date->month, $date->day, $date->hour, $date->minute, $date->second);
        $this->timestamp = $timestamp - $this->timezoneOffset;

        return $this;
    }

    public function subMonth($count)
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);
        $totalMonth = $date->month - $count;
        $year = $date->year;
        $month = $totalMonth;

        if ($totalMonth <= 0) {
            $totalMonth = -$totalMonth;
            $year -= floor($totalMonth / 12) + 1;
            $month = 12 - ($totalMonth % 12);
        }

        $timestamp = $this->currentCalendar->dateToTimestamp($year, $month, $date->day, $date->hour, $date->minute, $date->second);
        $this->timestamp = $timestamp - $this->timezoneOffset;

        return $this;
    }

    public function subDay($count)
    {
        $this->timestamp = $this->timestamp - ($count * 86400);

        return $this;
    }

    public function subHour($count)
    {
        $this->timestamp = $this->timestamp - ($count * 3600);

        return $this;
    }

    public function subMinute($count)
    {
        $this->timestamp = $this->timestamp - ($count * 60);

        return $this;
    }

    public function subSecond($count)
    {
        $this->timestamp = $this->timestamp - $count;

        return $this;
    }
}