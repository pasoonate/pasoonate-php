<?php

namespace Pasoonate\Traits;

use Pasoonate\Calendars\CalendarManager;
use Pasoonate\Constants;

trait Comparison
{
    public function equal(CalendarManager $other): bool
    {
        return $this->getTimestamp() === $other->getTimestamp();
    }

    public function afterThan(CalendarManager $other): bool
    {
        return $this->getTimestamp() > $other->getTimestamp();
    }

    public function afterThanOrEqual(CalendarManager $other): bool
    {
        return $this->getTimestamp() >= $other->getTimestamp();
    }

    public function beforeThan(CalendarManager $other): bool
    {
        return $this->getTimestamp() < $other->getTimestamp();
    }

    public function beforeThanOrEqual(CalendarManager $other): bool
    {
        return $this->getTimestamp() <= $other->getTimestamp();
    }

    public function between(CalendarManager $a, CalendarManager $b): bool
    {
        return $a->getTimestamp() <= $this->getTimestamp() && $b->getTimestamp() >= $this->getTimestamp();
    }

    public function min(CalendarManager $other): CalendarManager
    {
        return $this->getTimestamp() <= $other->getTimestamp() ? $this : $other;
    }

    public function max(CalendarManager $other): CalendarManager
    {
        return $this->getTimestamp() >= $other->getTimestamp() ? $this : $other;
    }

    public function isWeekday(): bool
    {
        return $this->dayOfWeek() !== Constants::FRIDAY;
    }

    public function isWeekend(): bool
    {
        return $this->dayOfWeek() === Constants::FRIDAY;
    }

    public function isSaturday(): bool
    {
        return $this->dayOfWeek() === Constants::SATURDAY;
    }

    public function isSunday(): bool
    {
        return $this->dayOfWeek() === Constants::SUNDAY;
    }

    public function isMonday(): bool
    {
        return $this->dayOfWeek() === Constants::MONDAY;
    }

    public function isTuesday(): bool
    {
        return $this->dayOfWeek() === Constants::TUESDAY;
    }

    public function isWednesday(): bool
    {
        return $this->dayOfWeek() === Constants::WEDNESDAY;
    }

    public function isThursday(): bool
    {
        return $this->dayOfWeek() === Constants::THURSDAY;
    }

    public function isFriday(): bool
    {
        return $this->dayOfWeek() === Constants::FRIDAY;
    }

    public function isYesterday(): bool
    {
        $yesterday = $this->clone()->gregorian()->subDay(1);

        return $this->gregorian()->diffInDays($yesterday) === 0;
    }

    public function isToday(): bool
    {
        $today = $this->clone()->gregorian();

        return $this->gregorian()->diffInDays($today) === 0;
    }

    public function isTomorrow(): bool
    {
        $tomorrow = $this->clone()->gregorian()->addDay(1);

        return $this->gregorian()->diffInDays($tomorrow) === 0;
    }

    public function isFuture(): bool
    {
        $today = $this->clone()->gregorian();

        return $this->gregorian()->diffInDays($today) > 1;
    }

    public function isPast(): bool
    {
        $today = $this->clone()->gregorian();

        return $today->gregorian()->diffInDays($this) > 1;
    }

    public function isLeapYear(): bool
    {
        return $this->currentCalendar->isLeap($this->getYear());
    }

    public function isSameDay(CalendarManager $other): bool
    {
        return $this->gregorian()->diffInDays($other) === 0;
    }
}