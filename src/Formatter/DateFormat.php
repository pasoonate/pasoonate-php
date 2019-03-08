<?php

namespace Pasoonate\Formatter;

use Pasoonate\Calendar\CalendarManager;

class DateFormat
{
	private $_calendar;

    public function __construct()
    {
    	$this->_calendar = null;
    }

	public function format()
	{
		if($this->getCalendar() === null) {
			return "";
		}

		return "$this->_calendar->getYear()-$this->_calendar->getMonth()-$this->_calendar->getDay() $this->_calendar->getHour():$this->_calendar->getMinute():$this->_calendar->getSecond()";
	}

    /**
     * @return CalendarManager
     */
    public function getCalendar()
    {
        return $this->_calendar;
    }

    public function setCalendar($calendar)
    {
        $this->_calendar = $calendar instanceof CalendarManager ? $calendar : null;
    }
}