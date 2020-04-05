<?php

namespace Pasoonate\Traits;

trait Modifiers
{
    public function startOfDay() {
        return $this->setTime(0, 0, 0);
    }
    
    public function endOfDay() {
        return $this->setTime(23, 59, 59);
    }
    
    public function startOfMonth() {
        return $this->setDay(1)->startOfDay();
    }
    
    public function endOfMonth() {
        return $this->setDay($this->currentCalendar->daysInMonth($this->getYear(), $this->getMonth()))->endOfDay();
    }

    public function startOfYear() {
        return $this->setMonth(1)->startOfMonth();
    }

    public function endOfYear() {
        return $this->setMonth(12)->endOfMonth();
    }

    public function startOfWeek() {
        $daysToSaturday = $this->dayOfWeek();

        return $this->subDay($daysToSaturday)->startOfDay();
    }

    public function endOfWeek() {
        $daysToFriday = 7 - $this->dayOfWeek();

        return $this->addDay($daysToFriday)->endOfDay();
    }
}