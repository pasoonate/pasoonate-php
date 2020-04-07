<?php

namespace Pasoonate\Calendars;

use Pasoonate\Formatters\DateFormat;
use Pasoonate\Pasoonate;
use Pasoonate\Traits\AdditionAndSubstraction;
use Pasoonate\Traits\Base;
use Pasoonate\Traits\Comparison;
use Pasoonate\Traits\Difference;
use Pasoonate\Traits\Modifiers;

class CalendarManager
{
    use Base;
    use AdditionAndSubstraction;
    use Difference;
    use Comparison;
    use Modifiers;

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
            $datetime = explode(' ', $expression);

            $date = $datetime[0] ?? null;
            $time = $datetime[1] ?? null;

            if ($date) {
                $date = preg_split("/[\/-]/", $date);
                $year = $date[0] ?? 1;
                $month = $date[1] ?? 1;
                $day = $date[2] ?? 1;
                
                $this->setDate(intval($year), intval($month) ?: 1, intval($day) ?: 1);
            }

            if ($time) {
                $time = explode(':', $time);
                $hour = $time[0] ?? 0;
                $minute = $time[1] ?? 0;
                $second = $time[2] ?? 0;

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