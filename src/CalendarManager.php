<?php

namespace MahdiBagheri\Pasoonate;

use MahdiBagheri\Pasoonate\Traits\AdditionAndSubstractionTrait;
use MahdiBagheri\Pasoonate\Traits\BaseMethodsTrait;

class CalendarManager
{
    protected $_timezoneOffset;
    private $_gregorian;
    private $_jalali;
    private $_islamic;
    private $_shia;
    private $_currentCalendar;
    private $_timestamp;

    use BaseMethodsTrait;
    use AdditionAndSubstractionTrait;

    public function __construct($timestamp, $timezoneOffset)
    {
        $this->_gregorian = new GregorianCalendar();
        $this->_jalali = new JalaliCalendar();
        $this->_islamic = new IslamicCalendar();
        $this->_shia = new ShiaCalendar();
        $this->_currentCalendar = null;
        $this->_timestamp = !is_null($timestamp) ? $timestamp : time();
        $this->_timezoneOffset = !is_null($timezoneOffset) && !is_string($timezoneOffset) ? $timezoneOffset : $this->getDefaultTimezoneOffset($timezoneOffset);
    }

    private function getDefaultTimezoneOffset($timezoneString = null)
    {
        if (is_null($timezoneString)) $timezoneString = date_default_timezone_get();

        $timezone = timezone_open($timezoneString);
        return timezone_offset_get($timezone, date_create());
    }

    public function gregorian($year = null, $month = null, $day = null, $hour = null, $minute = null, $second = null)
    {
        $date = $this->_gregorian->timestampToDate($this->_timestamp);
        $year = !is_null($year) ? $year : $date->year;
        $month = !is_null($month) ? $month : $date->month;
        $day = !is_null($day) ? $day : $date->day;
        $hour = !is_null($hour) ? $hour : $date->hour;
        $minute = !is_null($minute) ? $minute : $date->minute;
        $second = !is_null($second) ? $second : $date->second;
        $this->_timestamp = $this->_gregorian->dateToTimestamp($year, $month, $day, $hour, $minute, $second);
        $this->_currentCalendar = $this->_gregorian;
        return $this;
    }

    /**
     * @param integer $year
     * @param integer $month
     * @param integer $day
     * @param integer $hour
     * @param integer $minute
     * @param integer $second
     * @return CalendarManager
     */
    public function jalali($year = null, $month = null, $day = null, $hour = null, $minute = null, $second = null)
    {
        $date = $this->_jalali->timestampToDate($this->_timestamp);
        $year = !is_null($year) ? $year : $date->year;
        $month = !is_null($month) ? $month : $date->month;
        $day = !is_null($day) ? $day : $date->day;
        $hour = !is_null($hour) ? $hour : $date->hour;
        $minute = !is_null($minute) ? $minute : $date->minute;
        $second = !is_null($second) ? $second : $date->second;
        $this->_timestamp = $this->_jalali->dateToTimestamp($year, $month, $day, $hour, $minute, $second);
        $this->_currentCalendar = $this->_jalali;
        return $this;
    }

    public function islamic($year = null, $month = null, $day = null, $hour = null, $minute = null, $second = null)
    {
        $date = $this->_islamic->timestampToDate($this->_timestamp);
        $year = !is_null($year) ? $year : $date->year;
        $month = !is_null($month) ? $month : $date->month;
        $day = !is_null($day) ? $day : $date->day;
        $hour = !is_null($hour) ? $hour : $date->hour;
        $minute = !is_null($minute) ? $minute : $date->minute;
        $second = !is_null($second) ? $second : $date->second;
        $this->_timestamp = $this->_islamic->dateToTimestamp($year, $month, $day, $hour, $minute, $second);
        $this->_currentCalendar = $this->_islamic;
        return $this;
    }

    public function shia($year = null, $month = null, $day = null, $hour = null, $minute = null, $second = null)
    {
        $date = $this->_shia->timestampToDate($this->_timestamp);
        $year = !is_null($year) ? $year : $date->year;
        $month = !is_null($month) ? $month : $date->month;
        $day = !is_null($day) ? $day : $date->day;
        $hour = !is_null($hour) ? $hour : $date->hour;
        $minute = !is_null($minute) ? $minute : $date->minute;
        $second = !is_null($second) ? $second : $date->second;
        $this->_timestamp = $this->_shia->dateToTimestamp($year, $month, $day, $hour, $minute, $second);
        $this->_currentCalendar = $this->_shia;
        return $this;
    }

}