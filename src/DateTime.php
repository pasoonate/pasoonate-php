<?php

namespace Pasoonate;

class DateTime
{
    public $year;
    public $month;
    public $day;
    public $hour;
    public $minute;
    public $second;

    /**
     * @param int $year
     * @param int $month
     * @param int $day
     * @param int $hour
     * @param int $minute
     * @param int $second
     */
    public function __construct($year = 0, $month = 0, $day = 0, $hour = 0, $minute = 0, $second = 0)
    {
        $this->year = intval($year);
        $this->month = intval($month);
        $this->day = intval($day);
        $this->hour = intval($hour);
        $this->minute = intval($minute);
        $this->second = intval($second);
    }    
}