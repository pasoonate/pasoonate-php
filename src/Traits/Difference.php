<?php

namespace Pasoonate\Traits;

trait Difference
{
    public function diff($secondInstance)
    {
        $diffInSeconds = abs($this->getTimestamp() - $secondInstance->getTimestamp());

        $years = floor($diffInSeconds / 31536000); // Constants->DaysOfJalaliYear * 24 * 60 * 60
        $diffInSeconds %= 31536000;
        $months = floor($diffInSeconds / 2592000); // 30 * 24 * 60 * 60
        $diffInSeconds %= 2592000;
        $days = floor($diffInSeconds / 86400); // 24 * 60 * 60
        $diffInSeconds %= 86400;
        $hours = floor($diffInSeconds / 3600); // 60 * 60
        $diffInSeconds %= 3600;
        $minutes = floor($diffInSeconds / 60);
        $diffInSeconds %= 60;
        $seconds = $diffInSeconds;

        $diff = new \stdClass();
        $diff->years = $years;
        $diff->months = $months;
        $diff->days = $days;
        $diff->hours = $hours;
        $diff->minutes = $minutes;
        $diff->seconds = $seconds;

        return $diff;
    }

    public function diffInSeconds($secondInstance)
    {
        $diffInSeconds = abs($this->getTimestamp() - $secondInstance->getTimestamp());

        return $diffInSeconds;
    }

    public function diffInMinutes($secondInstance)
    {
        $diffInSeconds = abs($this->getTimestamp() - $secondInstance->getTimestamp());
        $diffInMinutes = $diffInSeconds > 60 ? floor($diffInSeconds / 60) : 0;

        return $diffInMinutes;
    }

    public function diffInHours($secondInstance)
    {
        $diffInSeconds = abs($this->getTimestamp() - $secondInstance->getTimestamp());
        $diffInHours = $diffInSeconds > 3600 ? floor($diffInSeconds / 3600) : 0;

        return $diffInHours;
    }

    public function diffInDays($secondInstance)
    {
        $diffInSeconds = abs($this->getTimestamp() - $secondInstance->getTimestamp());
        $diffInDays = $diffInSeconds > 86400 ? floor($diffInSeconds / 86400) : 0;

        return $diffInDays;
    }

    public function diffInMonths($secondInstance)
    {
        $diffInSeconds = abs($this->getTimestamp() - $secondInstance->getTimestamp());
        $diffInMonths = $diffInSeconds > 2592000 ? floor($diffInSeconds / 2592000) : 0;

        return $diffInMonths;
    }

    public function diffInYears($secondInstance)
    {
        $diffInSeconds = abs($this->getTimestamp() - $secondInstance->getTimestamp());
        $diffInYears = $diffInSeconds > 31536000 ? floor($diffInSeconds / 31536000) : 0;

        return $diffInYears;
    }
}