<?php

namespace Pasoonate\Traits;

trait DifferenceMethodsTrait
{
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

    public function diffInYears ($secondInstance) {
        $diffInSeconds = abs($this->getTimestamp() - $secondInstance->getTimestamp());
        $diffInYears = $diffInSeconds > 31536000 ? floor($diffInSeconds / 31536000) : 0;

        return $diffInYears;
    }	    
}