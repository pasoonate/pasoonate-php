<?php

namespace Pasoonate\Calendar;

use Pasoonate\Pasoonate;
use Pasoonate\Traits\AdditionAndSubstractionTrait;
use Pasoonate\Traits\BaseMethodsTrait;
use Pasoonate\Traits\DifferenceMethodsTrait;

class CalendarManager
{
    protected $_timezoneOffset;
    private $_gregorian;
    private $_jalali;
    private $_islamic;
    private $_shia;
    private $_currentCalendar;
    private $_formatter;
    private $_timestamp;

    use BaseMethodsTrait;
    use AdditionAndSubstractionTrait;
    use DifferenceMethodsTrait;

    public function __construct($timestamp, $timezoneOffset)
    {
        $this->_gregorian = new GregorianCalendar();
        $this->_jalali = new JalaliCalendar();
        $this->_islamic = new IslamicCalendar();
        $this->_shia = new ShiaCalendar();
        $this->_currentCalendar = null;
        $this->_formatter = Pasoonate::$formatter;

        $this->_timestamp = !is_null($timestamp) ? $timestamp : time();
        $this->_timezoneOffset = !is_null($timezoneOffset) && !is_string($timezoneOffset) ? $timezoneOffset : $this->getDefaultTimezoneOffset($timezoneOffset);
    }

    private function getDefaultTimezoneOffset($timezoneString = null)
    {
        $timezoneString = $timezoneString ?? date_default_timezone_get();
        $timezone = timezone_open($timezoneString);

        return timezone_offset_get($timezone, date_create());
    }

    /**
     * @param string $datetime
     * 
     * @return CalendarManager
     */
    public function gregorian($datetime = null)
    {
        $this->_currentCalendar = $this->_gregorian;

        return $this->parse($datetime);
    }

    /**
     * @param string $datetime
     * 
     * @return CalendarManager
     */
    public function jalali($datetime = null)
    {
        $this->_currentCalendar = $this->_jalali;

        return $this->parse($datetime);
    }

    /**
     * @param string $datetime
     * 
     * @return CalendarManager
     */
    public function islamic($datetime = null)
    {
        $this->_currentCalendar = $this->_islamic;

        return $this->parse($datetime);
    }

    /**
     * @param string $datetime
     * 
     * @return CalendarManager
     */
    public function shia($datetime = null)
    {
        $this->_currentCalendar = $this->_islamic;

        return $this->parse($datetime);
    }

    public function name()
    {
        return $this->_currentCalendar ? $this->_currentCalendar->getName() : '';
    }

    public function parse($expression)
    {
        if ($this->_currentCalendar && $expression) {
            list($date, $time) = explode(' ', $expression);

            if ($date) {
                list($year, $month, $day) = preg_split("/[\/-]/", $date);
                $this->setDate(intval($year), intval($month) ?: 1, intval($day) ?: 1);
            }

            if ($time) {
                list($hour, $minute, $second) = explode(':', $time);
                $this->setTime(intval($hour) ?: 0, intval($minute) ?: 0, intval($second) ?: 0);
            }
        }

        return $this;
    }

    public function format($pattern, $locale = null)
    {
        $this->_formatter->setCalendar($this);
        return $this->_formatter->format($pattern, $locale ?? Pasoonate::getLocale());
    }
}