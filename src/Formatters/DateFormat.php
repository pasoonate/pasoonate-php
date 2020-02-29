<?php

namespace Pasoonate\Formatters;

use Pasoonate\Calendars\CalendarManager;

class DateFormat
{
	private $calendar;

    public function __construct()
    {
    	$this->calendar = null;
    }

    /**
     * @return CalendarManager
     */
    public function getCalendar()
    {
        return $this->calendar;
    }

    public function setCalendar($calendar)
    {
        $this->calendar = $calendar instanceof CalendarManager ? $calendar : null;
    }

    public function format($pattern, $locale)
	{
		if($this->getCalendar() === null) {
			return "";
		}

		return "{$this->calendar->getYear()}-{$this->calendar->getMonth()}-{$this->calendar->getDay()} {$this->calendar->getHour()}:{$this->calendar->getMinute()}:{$this->calendar->getSecond()}";
	}
}