<?php

namespace Pasoonate\Formatter;

use Pasoonate\Pasoonate;

class SimpleDateFormat extends DateFormat
{
    const FullYear = 'yyyy';
    const ShortYear = 'yy';
    const FullMonthName = 'MMMM';
    const ShortMonthName = 'MMM';
    const FullMonth = 'MM';
    const ShortMonth = 'M';
    const ShortDayName = 'ddd';
    const FullDayName = 'dddd';
    const FullDay = 'dd';
    const ShortDay = 'd';
    const FullHour = 'HH';
    const ShortHour = 'H';
    const FullMinute = 'mm';
    const ShortMinute = 'm';
    const FullSecond = 'ss';
    const ShortSecond = 's';

    public function __construct()
    {
        parent::__construct();
    }

    public function format($pattern, $locale)
    {
        return $this->compile($pattern, $locale);
    }

    public function compile($pattern, $locale)
    {
        $categories = [];
        $prevChar = '';
        $currChar = '';
        $index = 0;

        for ($i = 0; $i < strlen($pattern); $i++) {
            $currChar = $pattern[$i];

            if ($currChar === '') {
                continue;
            }

            if ($currChar === $prevChar) {
                $categories[$index] .= $currChar;
            } else {
                $categories[++$index] = $currChar;
            }

            $prevChar = $currChar;
        }
        foreach ($categories as $key => $value) {
            switch ($value) {
                case $this::FullYear:
                    $categories[$key] = $this->getCalendar()->getYear();
                    break;
                case $this::ShortYear:
                    $categories[$key] = substr(strval($this->getCalendar()->getYear()), -2, 2);
                    break;
                case $this::FullMonthName:
                    $categories[$key] = Pasoonate::trans("{$this->getCalendar()->name()}.month_name.{$this->getCalendar()->getMonth()}");
                    break;
                case $this::ShortMonthName:
                    $categories[$key] = Pasoonate::trans("{$this->getCalendar()->name()}.short_month_name.{$this->getCalendar()->getMonth()}");
                    break;
                case $this::FullMonth:
                    $categories[$key] = $this->getCalendar()->getMonth() > 9 ? $this->getCalendar()->getMonth() : "0{$this->getCalendar()->getMonth()}";
                    break;
                case $this::ShortMonth:
                    $categories[$key] = $this->getCalendar()->getMonth();
                    break;
                case $this::FullDayName:
                    $categories[$key] = Pasoonate::trans("{$this->getCalendar()->name()}.short_day_name.{$this->getCalendar()->getDay()}");
                    break;
                case $this::ShortDayName:
                    $categories[$key] = Pasoonate::trans("{$this->getCalendar()->name()}.day_name.{$this->getCalendar()->getDay()}");
                    break;
                case $this::FullDay:
                    $categories[$key] = $this->getCalendar()->getDay() > 9 ? $this->getCalendar()->getDay() : "0{$this->getCalendar()->getDay()}";
                    break;
                case $this::ShortDay:
                    $categories[$key] = $this->getCalendar()->getDay();
                    break;
                case $this::FullHour:
                    $categories[$key] = $this->getCalendar()->getHour() > 9 ? $this->getCalendar()->getHour() : "0{$this->getCalendar()->getHour()}";
                    break;
                case $this::ShortHour:
                    $categories[$key] = $this->getCalendar()->getHour();
                    break;
                case $this::FullMinute:
                    $categories[$key] = $this->getCalendar()->getMinute() > 9 ? $this->getCalendar()->getMinute() : "0{$this->getCalendar()->getMinute()}";
                    break;
                case $this::ShortMinute:
                    $categories[$key] = $this->getCalendar()->getMinute();
                    break;
                case $this::FullSecond:
                    $categories[$key] = $this->getCalendar()->getSecond() > 9 ? $this->getCalendar()->getSecond() : "0{$this->getCalendar()->getSecond()}";
                    break;
                case $this::ShortSecond:
                    $categories[$key] = $this->getCalendar()->getSecond();
                    break;
            }
        }

        return join($categories, '');

    }
}