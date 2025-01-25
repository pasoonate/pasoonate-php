<?php

declare(strict_types=1);

namespace Pasoonate\Traits;

use Pasoonate\Calendars\CalendarManager;

trait Modifiers
{
    public function startOfDay(): CalendarManager
    {
        return $this->setTime(0, 0, 0);
    }

    public function endOfDay(): CalendarManager
    {
        return $this->setTime(23, 59, 59);
    }

    public function startOfMonth(): CalendarManager
    {
        return $this->setDay(1)->startOfDay();
    }

    public function endOfMonth(): CalendarManager
    {
        return $this->setDay($this->currentCalendar->daysInMonth($this->getYear(), $this->getMonth()))->endOfDay();
    }

    public function startOfYear(): CalendarManager
    {
        return $this->setMonth(1)->startOfMonth();
    }

    public function endOfYear(): CalendarManager
    {
        return $this->setMonth(12)->endOfMonth();
    }

    public function startOfWeek(): CalendarManager
    {
        $daysToSaturday = $this->dayOfWeek();

        return $this->subDay($daysToSaturday)->startOfDay();
    }

    public function endOfWeek(): CalendarManager
    {
        $daysToFriday = 7 - $this->dayOfWeek();

        return $this->addDay($daysToFriday)->endOfDay();
    }
}