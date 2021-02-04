<?php

namespace Pasoonate;

class Time
{
    public $hour;
    public $minute;
    public $second;

    /**
     * @param int $hour
     * @param int $minute
     * @param int $second
     */
    public function __construct($hour = 0, $minute = 0, $second = 0)
    {
        $this->hour = intval($hour);
        $this->minute = intval($minute);
        $this->second = intval($second);
    }
}