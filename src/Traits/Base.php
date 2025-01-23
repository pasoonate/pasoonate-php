<?php

namespace Pasoonate\Traits;

use Pasoonate\Calendars\CalendarManager;
use Pasoonate\Date;
use Pasoonate\DateTime;
use Pasoonate\Time;

trait Base
{
    public function setTimestamp(int $timestamp): CalendarManager
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public function setTimezoneOffset(int $timezoneOffset): CalendarManager
    {
        $this->timezoneOffset = $timezoneOffset;

        return $this;
    }

    public function getTimezoneOffset(): int
    {
        return $this->timezoneOffset;
    }

    public function setYear(int $year): CalendarManager
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);
        $timestamp = $this->currentCalendar->dateToTimestamp($year, $date->month, $date->day, $date->hour, $date->minute, $date->second);
        $this->timestamp = $timestamp - $this->timezoneOffset;

        return $this;
    }

    public function getYear(): int
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);

        return $date->year;
    }

    public function setJulianDayNumber(float $julianDay): CalendarManager
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

    public function getJulianDayNumber(): float
    {
        return $this->currentCalendar->dateToJulianDay($this->getYear(), $this->getMonth(), $this->getDay(), $this->getHour(), $this->getMinute(), $this->getSecond());
    }

    public function setMonth(int $month): CalendarManager
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);
        $timestamp = $this->currentCalendar->dateToTimestamp($date->year, $month, $date->day, $date->hour, $date->minute, $date->second);
        $this->timestamp = $timestamp - $this->timezoneOffset;

        return $this;
    }

    public function getMonth(): int
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);

        return $date->month;
    }

    public function setDay(int $day): CalendarManager
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);
        $timestamp = $this->currentCalendar->dateToTimestamp($date->year, $date->month, $day, $date->hour, $date->minute, $date->second);
        $this->timestamp = $timestamp - $this->timezoneOffset;

        return $this;
    }

    public function getDay(): int
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);

        return $date->day;
    }

    public function setHour(int $hour): CalendarManager
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

    public function setMinute(int $minute): CalendarManager
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

    public function setSecond(int $second): CalendarManager
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

    public function setUTCYear(int $year): CalendarManager
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

    public function setUTCMonth(int $month): CalendarManager
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

    public function setUTCDay(int $day): CalendarManager
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

    public function setUTCHour(int $hour): CalendarManager
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

    public function setUTCMinute(int $minute): CalendarManager
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

    public function setUTCSecond(int $second): CalendarManager
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

    public function setDate(int $year, int $month, int $day): CalendarManager
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);
        $timestamp = $this->currentCalendar->dateToTimestamp($year, $month, $day, $date->hour, $date->minute, $date->second);
        $this->timestamp = $timestamp - $this->timezoneOffset;

        return $this;
    }

    public function getDate(): Date
    {
        $datetime = $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);
        return new Date($datetime->year, $datetime->month, $datetime->day);
    }

    public function setTime(int $hour, int $minute, int $second): CalendarManager
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);
        $timestamp = $this->currentCalendar->dateToTimestamp($date->year, $date->month, $date->day, $hour, $minute, $second);
        $this->timestamp = $timestamp - $this->timezoneOffset;

        return $this;
    }

    public function getTime(): Time
    {
        $datetime = $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);
        return new Time($datetime->hour, $datetime->minute, $datetime->second);
    }

    public function setDateTime(int $year, int $month, int $day, int $hour, int $minute, int $second): CalendarManager
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);
        $timestamp = $this->currentCalendar->dateToTimestamp($year, $month, $day, $hour, $minute, $second);
        $this->timestamp = $timestamp - $this->timezoneOffset;

        return $this;
    }

    public function getDateTime(): DateTime
    {
        return $this->currentCalendar->timestampToDate($this->timestamp + $this->timezoneOffset);
    }

    public function setUTCDate(int $year, int $month, int $day): CalendarManager
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp);
        $this->timestamp = $this->currentCalendar->dateToTimestamp($year, $month, $day, $date->hour, $date->minute, $date->second);

        return $this;
    }

    public function setUTCTime(int $hour, int $minute, int $second): CalendarManager
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp);
        $this->timestamp = $this->currentCalendar->dateToTimestamp($date->year, $date->month, $date->day, $hour, $minute, $second);

        return $this;
    }

    public function setUTCDateTime(int $year, int $month, int $day, int $hour, int $minute, int $second): CalendarManager
    {
        $date = $this->currentCalendar->timestampToDate($this->timestamp);
        $this->timestamp = $this->currentCalendar->dateToTimestamp($year, $month, $day, $hour, $minute, $second);

        return $this;
    }

    public function dayOfWeek(): int
    {
        return $this->currentCalendar->dayOfWeek($this->timestamp + $this->timezoneOffset);
    }

    public function dayOfYear(): int
    {
        return $this->currentCalendar->dayOfYear($this->timestamp + $this->timezoneOffset);
    }

    public function weekOfMonth(): int
    {
        return $this->currentCalendar->weekOfMonth($this->timestamp + $this->timezoneOffset);
    }

    public function weekOfYear(): int
    {
        return $this->currentCalendar->weekOfYear($this->timestamp + $this->timezoneOffset);
    }

    public function daysInMonth(): int
    {
        return $this->currentCalendar->daysInMonth($this->getYear(), $this->getMonth());
    }
}