<?php

namespace Pasoonate\Parsers;

use Pasoonate\Calendars\CalendarManager;

class Parser
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

    public function parse($format, $text)
	{
		
	}
}