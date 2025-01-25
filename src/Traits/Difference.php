<?php

declare(strict_types=1);

namespace Pasoonate\Traits;

use Pasoonate\Calendars\CalendarManager;
use Pasoonate\Constants;

trait Difference
{
    public function diff(CalendarManager $instance): \stdClass
    {
        $diffInSeconds = $this->diffInSeconds($instance);
        $diffInDays = $diffInSeconds / Constants::DAY_IN_SECONDS;

        $years = (int)$diffInDays / Constants::YEAR_IN_DAYS;
        $months = (int)$diffInDays / Constants::MONTH_IN_DAYS;
        $days = $this->diffInDays($instance) % Constants::MONTH_IN_DAYS;
        $hours = $this->diffInHours($instance) % Constants::HOURS_PER_DAY;
        $minutes = $this->diffInMinutes($instance) % Constants::MINUTES_PER_HOUR;
        $seconds = $diffInSeconds % Constants::SECONDS_PER_MINUTE;

        $diff = new \stdClass();
        $diff->years = (int)$years;
        $diff->months = (int)$months;
        $diff->days = (int)$days;
        $diff->hours = (int)$hours;
        $diff->minutes = (int)$minutes;
        $diff->seconds = (int)$seconds;

        return $diff;
    }

    public function diffInSeconds($instance): int
    {
        $diffInSeconds = abs($this->getTimestamp() - $instance->getTimestamp());

        return $diffInSeconds;
    }

    public function diffInMinutes(CalendarManager $instance): int
    {
        $diffInSeconds = abs($this->getTimestamp() - $instance->getTimestamp());
        $diffInMinutes = $diffInSeconds >= Constants::SECONDS_PER_MINUTE ? (int)($diffInSeconds / Constants::SECONDS_PER_MINUTE) : 0;

        return $diffInMinutes;
    }

    public function diffInHours(CalendarManager $instance): int
    {
        $diffInSeconds = abs($this->getTimestamp() - $instance->getTimestamp());
        $diffInHours = $diffInSeconds >= Constants::HOUR_IN_SECONDS ? (int)($diffInSeconds / Constants::HOUR_IN_SECONDS) : 0;

        return $diffInHours;
    }

    public function diffInDays(CalendarManager $instance): int
    {
        $diffInSeconds = abs($this->getTimestamp() - $instance->getTimestamp());
        $diffInDays = $diffInSeconds >= Constants::DAY_IN_SECONDS ? (int)($diffInSeconds / Constants::DAY_IN_SECONDS) : 0;

        return $diffInDays;
    }

    public function diffInMonths(CalendarManager $instance): int
    {
        $diffInSeconds = abs($this->getTimestamp() - $instance->getTimestamp());
        $diffInMonths = $diffInSeconds >= Constants::MONTH_IN_SECONDS ? (int)($diffInSeconds / Constants::MONTH_IN_SECONDS) : 0;

        return $diffInMonths;
    }

    public function diffInYears(CalendarManager $instance): int
    {
        $diffInSeconds = abs($this->getTimestamp() - $instance->getTimestamp());
        $diffInYears = $diffInSeconds >= Constants::YEAR_IN_SECONDS ? (int)($diffInSeconds / Constants::YEAR_IN_SECONDS) : 0;

        return $diffInYears;
    }
}