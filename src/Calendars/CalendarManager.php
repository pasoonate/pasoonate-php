<?php

namespace Pasoonate\Calendars;

use Pasoonate\Formatters\DateFormat;
use Pasoonate\Parsers\Parser;
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
     * @var Parser $parser
     */
    private $gregorian;
    private $jalali;
    private $islamic;
    private $shia;
    private $currentCalendar;
    private $formatter;
    private $parser;
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
        $this->parser = Pasoonate::$parser;

        $this->timestamp = $timestamp ?? time();
        $this->timezoneOffset = (is_null($timezoneOffset) || is_string($timezoneOffset)) ? $this->getDefaultTimezoneOffset($timezoneOffset) : $timezoneOffset;
    }  

    /**
     * @param string $datetime
     * 
     * @return CalendarManager
     */
    public function gregorian($datetime = null)
    {
        $this->currentCalendar = $this->gregorian;
        
        if($datetime) {
            $this->parse('yyyy-MM-dd HH:mm:ss', $datetime);
        }

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

        if($datetime) {
            $this->parse('yyyy/MM/dd HH:mm:ss', $datetime);
        }
        
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

        if($datetime) {
            $this->parse('yyyy-MM-dd HH:mm:ss', $datetime);
        }

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

        if($datetime) {
            $this->parse('yyyy-MM-dd HH:mm:ss', $datetime);
        }

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
     * @param string $pattern
     * @param string $text
     * 
     * @return CalendarManager
     */
    public function parse($pattern, $text)
    {
        $this->parser->setCalendar($this);

        $this->parser->parse($pattern, $text);

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