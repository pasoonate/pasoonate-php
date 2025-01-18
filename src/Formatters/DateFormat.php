<?php

namespace Pasoonate\Formatters;

use Pasoonate\Calendars\CalendarManager;

class DateFormat
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

    public function format(string $pattern, string $locale)
    {
        if ($this->getCalendar() === null) {
            return "";
        }

        return "{$this->calendar->getYear()}-{$this->calendar->getMonth()}-{$this->calendar->getDay()} {$this->calendar->getHour()}:{$this->calendar->getMinute()}:{$this->calendar->getSecond()}";
    }
}