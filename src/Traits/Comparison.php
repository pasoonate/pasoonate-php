<?php

namespace Pasoonate\Traits;

use Pasoonate\Calendars\CalendarManager;
use Pasoonate\Constants;

trait Comparison
{
    /**
     * @param CalendarManager $other
     *
     * @return bool
     */
    public function equal(CalendarManager $other)
    {
        return $this->getTimestamp() === $other->getTimestamp();
    }

    /**
     * @param CalendarManager $other
     *
     * @return bool
     */
    public function afterThan(CalendarManager $other)
    {
        return $this->getTimestamp() > $other->getTimestamp();
    }

    /**
     * @param CalendarManager $other
     *
     * @return bool
     */
    public function afterThanOrEqual(CalendarManager $other)
    {
        return $this->getTimestamp() >= $other->getTimestamp();
    }

    /**
     * @param CalendarManager $other
     *
     * @return bool
     */
    public function beforeThan(CalendarManager $other)
    {
        return $this->getTimestamp() < $other->getTimestamp();
    }

    /**
     * @param CalendarManager $other
     *
     * @return bool
     */
    public function beforeThanOrEqual(CalendarManager $other)
    {
        return $this->getTimestamp() <= $other->getTimestamp();
    }

    /**
     * @param CalendarManager $a
     * @param CalendarManager $b
     *
     * @return bool
     */
    public function between(CalendarManager $a, CalendarManager $b)
    {
        return $a->getTimestamp() <= $this->getTimestamp() && $b->getTimestamp() >= $this->getTimestamp();
    }

    /**
     * @param CalendarManager $other
     *
     * @return bool
     */
    public function min(CalendarManager $other)
    {
        return $this->getTimestamp() <= $other->getTimestamp() ? $this : $other;
    }

    /**
     * @param CalendarManager $other
     *
     * @return bool
     */
    public function max(CalendarManager $other)
    {
        return $this->getTimestamp() >= $other->getTimestamp() ? $this : $other;
    }

    /**
     *
     * @return bool
     */
    public function isWeekday()
    {
        return $this->dayOfWeek() !== Constants::FRIDAY;
    }

    /**
     *
     * @return bool
     */
    public function isWeekend()
    {
        return $this->dayOfWeek() === Constants::FRIDAY;
    }

    /**
     *
     * @return bool
     */
    public function isSaturday()
    {
        return $this->dayOfWeek() === Constants::SATURDAY;
    }

    /**
     *
     * @return bool
     */
    public function isSunday()
    {
        return $this->dayOfWeek() === Constants::SUNDAY;
    }

    /**
     *
     * @return bool
     */
    public function isMonday()
    {
        return $this->dayOfWeek() === Constants::MONDAY;
    }

    /**
     *
     * @return bool
     */
    public function isTuesday()
    {
        return $this->dayOfWeek() === Constants::TUESDAY;
    }

    /**
     *
     * @return bool
     */
    public function isWednesday()
    {
        return $this->dayOfWeek() === Constants::WEDNESDAY;
    }

    /**
     *
     * @return bool
     */
    public function isThursday()
    {
        return $this->dayOfWeek() === Constants::THURSDAY;
    }

    /**
     *
     * @return bool
     */
    public function isFriday()
    {
        return $this->dayOfWeek() === Constants::FRIDAY;
    }

    /**
     *
     * @return bool
     */
    public function isYesterday()
    {
        $yesterday = $this->clone()->gregorian()->subDay(1);

        return $this->gregorian()->diffInDays($yesterday) === 0;
    }

    /**
     *
     * @return bool
     */
    public function isToday()
    {
        $today = $this->clone()->gregorian();

        return $this->gregorian()->diffInDays($today) === 0;
    }

    /**
     *
     * @return bool
     */
    public function isTomorrow()
    {
        $tomorrow = $this->clone()->gregorian()->addDay(1);

        return $this->gregorian()->diffInDays($tomorrow) === 0;
    }

    /**
     *
     * @return bool
     */
    public function isFuture()
    {
        $today = $this->clone()->gregorian();

        return $this->gregorian()->diffInDays($today) > 1;
    }

    /**
     *
     * @return bool
     */
    public function isPast()
    {
        $today = $this->clone()->gregorian();

        return $today->gregorian()->diffInDays($this) > 1;
    }

    /**
     *
     * @return bool
     */
    public function isLeapYear()
    {
        return $this->currentCalendar->isLeap($this->getYear());
    }

    /**
     * @param CalendarManager $other
     *
     * @return bool
     */
    public function isSameDay(CalendarManager $other)
    {
        return $this->gregorian()->diffInDays($other) === 0;
    }
}