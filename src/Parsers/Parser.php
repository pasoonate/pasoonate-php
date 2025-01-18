<?php

namespace Pasoonate\Parsers;

use Pasoonate\Calendars\CalendarManager;

class Parser
{
    private CalendarManager|null $calendar;

    public function __construct()
    {
        $this->calendar = null;
    }

    public function getCalendar(): CalendarManager
    {
        return $this->calendar;
    }

    public function setCalendar(CalendarManager|null $calendar): void
    {
        $this->calendar = $calendar instanceof CalendarManager ? $calendar : null;
    }

    public function parse(string $format, string $text)
    {

    }
}