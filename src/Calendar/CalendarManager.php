<?php

namespace Pasoonate\Calendar;

use Pasoonate\Formatter\DateFormat;
use Pasoonate\Pasoonate;
use Pasoonate\Traits\AdditionAndSubstractionTrait;
use Pasoonate\Traits\BaseMethodsTrait;
use Pasoonate\Traits\DifferenceMethodsTrait;

class CalendarManager
{
    use BaseMethodsTrait;
    use AdditionAndSubstractionTrait;
    use DifferenceMethodsTrait;

    /**
     * @var GregorianCalendar $gregorian
     * @var JalaliCalendar $jalali
     * @var IslamicCalendar $islamic
     * @var ShiaCalendar $shia
     * @var Calendar $currentCalendar
     * @var DateFormat $formatter
     */
    private $gregorian;
    private $jalali;
    private $islamic;
    private $shia;
    private $currentCalendar;
    private $formatter;
    private $timestamp;
    private $timezoneOffset;

    public function __construct($timestamp, $timezoneOffset)
    {
        $this->gregorian = new GregorianCalendar();
        $this->jalali = new JalaliCalendar();
        $this->islamic = new IslamicCalendar();
        $this->shia = new ShiaCalendar();
        $this->currentCalendar = null;
        $this->formatter = Pasoonate::$formatter;

        $this->timestamp = $timestamp ?? time();
        $this->timezoneOffset = is_null($timezoneOffset) && is_string($timezoneOffset) ? $this->getDefaultTimezoneOffset($timezoneOffset) : $timezoneOffset;
    }  

    /**
     * @param string $datetime
     * 
     * @return CalendarManager
     */
    public function gregorian($datetime = null)
    {
        $this->currentCalendar = $this->gregorian;
        $this->parse($datetime);

        return $this;
    }

    /**
     * @param string $datetime
     * 
     * @return CalendarManager
     */
    public function jalali($datetime = null)
    {
        $this->currentCalendar = $this->jalali;
        $this->parse($datetime);
        
        return $this;
    }

    /**
     * @param string $datetime
     * 
     * @return CalendarManager
     */
    public function islamic($datetime = null)
    {
        $this->currentCalendar = $this->islamic;
        $this->parse($datetime);

        return $this;
    }

    /**
     * @param string $datetime
     * 
     * @return CalendarManager
     */
    public function shia($datetime = null)
    {
        $this->currentCalendar = $this->shia;
        $this->parse($datetime);

        return $this;
    }

    /**
     * @param string|null $calendar calendar name
     * 
     * @return string
     */
    public function name($calendar = null)
    {
        if($calendar) {
            $calendar = strtolower($calendar);
            $instance = $this->$calendar ?? null;

            if($instance) {
                $this->currentCalendar = $instance;
            }

            return;
        }

        return $this->currentCalendar ? $this->currentCalendar->getName() : '';
    }

    /**
     * @param string $expression
     * 
     * @return CalendarManager
     */
    public function parse($expression)
    {
        if ($this->currentCalendar && $expression) {
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

    /**
     * @param string $pattern
     * @param string|null $locale
     * 
     * @return string 
     */
    public function format($pattern, $locale = null)
    {
        $this->formatter->setCalendar($this);

        return $this->formatter->format($pattern, $locale ?? Pasoonate::getLocale());
    }

    /**
     * @return CalendarManager
     */
    public function clone()
    {
        return Pasoonate::make($this->getTimestamp(), $this->getTimezoneOffset());
    }

    private function getDefaultTimezoneOffset($timezoneString = null)
    {
        $timezoneString = $timezoneString ?? date_default_timezone_get();
        $timezone = timezone_open($timezoneString);

        return timezone_offset_get($timezone, date_create());
    }

}